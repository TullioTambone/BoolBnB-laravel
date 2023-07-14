<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Apartment;
use App\Models\Admin\Image;

use App\Models\Admin\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // assegniamo alla variabile $apartments tutti i record della tabella apartments grazie al metodo statico ( Project::All() )
        // $apartments = Apartment::All();

        $apartments = auth()->user()->apartments;
        

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

        return view('admin.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(), 
            [
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'array', // Aggiornamento qui
            'images.*.image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // E qui
            ]
        );
        // salvataggio campi form
        $form_data = $request->all();
        
        // creazione nuova istanza dalla classe padre 
        $new_apartment = new Apartment();

        $new_apartment->user_id = auth()->user()->id;

        $slug = Apartment::toSlug($request->title);
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
        
        // salvo nell'istanza apartment i dati compilati nel form dall'utente
        $new_apartment->fill($form_data);
        
        //  salvo le informazioni
        $new_apartment->save();

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
        return view('admin.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $singolo_apartment = Apartment::findOrFail($id);
        $services = Service::all();
        return view('admin.edit', compact('singolo_apartment', 'services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apartment = Apartment::findOrFail($id);
        
        if($apartment->cover) {
            Storage::delete($apartment->cover);
        }

        $apartment->services()->sync([]);
        
        $apartment->delete();
        return redirect()->route('admin.index');
    }
}
