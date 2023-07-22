<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Apartment;
use App\Models\Admin\Service;
use Illuminate\Http\Request;


class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Apartment::with('services');
        
        if ($request->has('services_ids')) {
            $servicesIds = explode(',', $request->services_ids);
            $query->whereHas('services', function ($query) use ($servicesIds) {
                $query->whereIn('id', $servicesIds);
            });
        }
        
        //filtro stanze
        if($request->has('rooms')){
            $rooms = $request->input('rooms');
            // Se il parametro 'rooms' è presente nella richiesta e ha un valore numerico valido
            if ($rooms && is_numeric($rooms)) {
                // Aggiungi una clausola WHERE per filtrare gli appartamenti in base al numero di stanze
                if($rooms >= 5){

                    $query->where('rooms', '>=', $rooms);
                }else{

                    $query->where('rooms', '=', $rooms);
                }

            }
        }

        //filtro stanze da letto
        if($request->has('bedrooms')){
            $bedrooms = $request->input('bedrooms');
            // Se il parametro 'bedrooms' è presente nella richiesta e ha un valore numerico valido
            if ($bedrooms && is_numeric($bedrooms)) {
                // Aggiungi una clausola WHERE per filtrare gli appartamenti in base al numero di stanze
                if($bedrooms >= 5){

                    $query->where('bedrooms', '>=', $bedrooms);
                }else{
                    
                    $query->where('bedrooms', '=', $bedrooms);
                }

            }
        }

        //filtro 20km
        if($request->has('address')){
            $address = $request->input('address');

            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');

            // Controlla se le coordinate di latitudine e longitudine sono state ricevute
            if ($latitude && $longitude) {
                //salvo la variable distance dal front
                $distance = $request->input('distance');
                
                if($distance){
                    // Costruisci la query per recuperare gli appartamenti filtrati nel raggio di 20 km dalla latitudine e longitudine
                    $query = Apartment::query();
                    $query->whereRaw("ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) <= ?", [$longitude, $latitude, $distance * 1000]);

                }else{
                    $query = Apartment::query();
                    $query->whereRaw("ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) <= 20000", [$longitude, $latitude]);
                }
            }
            dd($query->toSql(), $query->getBindings());
            $query->where('address', 'LIKE', '%' . $address . '%');
        }

        $apartment = $query->paginate(3);

        return response()->json([
            'success' => true,
            'apartment' => $apartment
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        // $Apartments = Apartment::with( 'image', 'service')->get();
        // $apartment = Apartment::with( 'image', 'service')->where('slug', $slug)->first();

        // if($apartment) {

        //     return response()->json([
        //         'success' => true,
        //         'apartment' => $apartment
        //     ]);
        // } else {
        //     return response()->json([
        //         'success' => false,
        //         'error' => "Non c'è nessun elemento"
        //     ])->setStatusCode(404);
        // }
    
    }

}