<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use Braintree\Gateway;

// models
use App\Models\Admin\Apartment;
use App\Models\Admin\Image;
use App\Models\Admin\Service;
use App\Models\Admin\Subscription;

// requests
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;

class ApartmentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $apartments = auth()->user()->apartments;

        // if ($apartments->user_id !== auth()->user()->id) {
        //     abort(403, "Non hai il permesso di visualizzare questo appartamento.");
        // } else {
        //    
        // }
        return view('admin.index', compact('apartments')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
    

        $services = Service::all();
        $images = Image::all();
     
        return view('admin.create', compact('services', 'images'));

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApartmentRequest $request)
    {
        // salvataggio campi form passati dalla validazione di StoreApartmentRequest
        $form_data = $request->validated();
        
        // creazione nuova istanza dalla classe padre 
        $new_apartment = new Apartment();

        $new_apartment->user_id = auth()->user()->id;

        $slug = Apartment::toSlug($request->title, $new_apartment->user_id);
        // dd($new_apartment->user_id);
        $form_data['slug'] = $slug;

        

        //condizione per passare true o false come numeri poiché mysql accetta per valori boolean 0 e 1 e non stringhe
        if($request->has('visibility') == 'true'){
            $form_data['visibility'] = 1;
        }else {
            $form_data['visibility'] = 0;
        }

        // controllo e salvataggio delle immagini di copertina
        if ($request->hasFile('cover')) {
            $path = Storage::disk('public')->put('apartment_cover_img', $request->cover);
            $form_data['cover'] = $path;
        }

        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        // dd($latitude, $longitude);
        $form_data['latitude'] = $latitude;
        $form_data['longitude'] = $longitude;
        
        // salvo nell'istanza apartment i dati compilati nel form dall'utente
        $new_apartment->fill($form_data);
        
        //  salvo le informazioni
        $new_apartment->save();
        // dd($request->file('images'));
        // Controllo e salvataggio delle immagini aggiuntive
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                if ($image && $image->isValid()) {
                    $path = Storage::disk('public')->put('images', $image);
    
                    $new_image = new Image();
                    $new_image->url = $path;
                    $new_image->apartment_id = $new_apartment->id;
                    $new_image->save();
                }
            }
        }
            
        // controllo che in $request abbia le informazioni dell'input nel create(services) che mi manderà tramite array gli id della tabella 'services'
        if($request->has('services')) {
            
            /* 
                $new_apartment->services() :
                    interrogo la funzione di relazione scritta nel modello Apartment
                ->attach($request->services) :
                    con la funzione attach() creiamo tanti record quanti sono i collegamenti nella tabella pivot
            */
            $new_apartment->services()->attach($request->services);
        } 

        // reindirizzamento alla pagina index
        return redirect()->route('admin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {

        $sub = Subscription::all();

        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);
    
        $clientToken = $gateway->clientToken()->generate();

        // Verifica se l'utente loggato è il proprietario dell'appartamento
        if ($apartment->user_id !== auth()->user()->id) {
            abort(403, "Non hai il permesso di visualizzare questo appartamento.");
        } else {
            return view('admin.show', compact('apartment', 'sub', 'clientToken'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        // $singolo_apartment = Apartment::findOrFail($id);
        $services = Service::all();

        if ( $apartment->user_id !== auth()->user()->id) {
            abort(403, "Non hai il permesso di visualizzare questo appartamento.");
        } else {
            return view('admin.edit', compact('apartment', 'services'));
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {

        $apartment->user_id = auth()->user()->id;

        // salvataggio campi form passati dalla validazione di UpdateApartmentRequest
        $form_data = $request->validated();
        
        // $apartment = Apartment::findOrFail($id);

        // $request->validate([
        //     'title' => 'required|unique:apartments,title,'.$apartment->id,
        // ],
        // [
        //     'title.required' => 'Il campo Titolo è obbligatorio'
        // ]);

        //se nella richiesta è presente il file cover
        if ($request->hasfile('cover')) {
            
            // solo se il file esiste dentro la tabella 'apartments'
            if( $apartment->cover ){
                //cancellalo
                Storage::delete( $apartment->cover );
            }

            if ($form_data['cover']->isValid()) {
                //aggiorna il file all'interno della cartella dedicata per le immagini cover
                $path = Storage::disk('public')->put('apartment_cover_img', $request->cover);
        
                $form_data['cover'] = $path; 
            }
        }
        
        $slug = Apartment::toSlug($request->title, $apartment->user_id);
        $form_data['slug'] = $slug;

        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        // dd($latitude, $longitude);
        $form_data['latitude'] = $latitude;
        $form_data['longitude'] = $longitude;

        //aggiorna le informazioni
        $apartment->update($form_data);

        // gestione e aggiornamento delle checkbox
        // se esistono gli id
        if($request->has('services')) {
            $apartment->services()->sync($request->services);

        // altrimenti va svuotato
        } else {
            $apartment->services()->sync([]);
        }

        if ($request->hasFile('images')) {

            // la funzione delete() rimuoverà tutte le immagini associate all'appartamento prima di salvare le nuove immagini
            $apartment->images()->delete();

            foreach ($request->file('images') as $image) {

                if ($image && $image->isValid()) {
                    $path = Storage::disk('public')->put('images', $image);
    
                    $new_image = new Image();
                    $new_image->url = $path;
                    $new_image->apartment_id = $apartment->id;
                    $new_image->save();
                }
            }
        }

        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment  $apartment)
    {
        // $apartment = Apartment::findOrFail($id);
        
        if($apartment->cover) {
            Storage::delete($apartment->cover);
        }

        $apartment->services()->sync([]);

        $apartment->images()->delete();
        
        $apartment->delete();
        return redirect()->route('admin.index');
    }
}
