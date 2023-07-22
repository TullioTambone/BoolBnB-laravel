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

        //filtro indirizzo
        if($request->has('address')){
            $address = $request->input('address');
        
            $distance = $request->input('distance');

            if($distance !== '20'){
                $data = $request->all('latitude', 'longitude');
                $latitude = $data['latitude'];
                $longitude = $data['longitude'];
                
                $query = Apartment::query();
                $query->whereRaw("ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) <= ?", [$longitude, $latitude, $distance * 1000]);
            }
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