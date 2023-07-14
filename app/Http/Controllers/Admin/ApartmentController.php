<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Apartment;
use App\Models\Admin\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
      
        // salvataggio campi form
        $form_data = $request->all();
        
        // creazione nuova istanza dalla classe padre 
        $new_apartment = new Apartment();

        $new_apartment->user_id = auth()->user()->id;

        $slug = Apartment::toSlug($request->title);
        $form_data['slug'] = $slug;

        if($request->has('visibility') == 'true'){
            $form_data['visibility'] = 1;
        }else {
            $form_data['visibility'] = 0;
        }

        if ($request->hasFile('cover')) {
            $path = Storage::disk('public')->put('apartment_cover_img', $request->cover);
            $form_data['cover'] = $path;
        }
        
        // salvo nell'istanza apartment i dati compilati nel form dall'utente
        $new_apartment->fill($form_data);
        
        //  salvo le informazioni
        $new_apartment->save();
        
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        //
    }
}
