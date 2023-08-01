<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Apartment;
use App\Models\Admin\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Apartment::with('services', 'images', 'subscriptions');        

        $rooms = $request->input('rooms');		
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        // filtro servizi
        if ($request->has('services_ids')) {
            $servicesIds = explode(',', $request->services_ids);
            $query->whereHas('services', function ($query) use ($servicesIds) {
                $query->whereIn('id', $servicesIds);
            });
        }
        
        //filtro stanze
        if($request->has('rooms')){
            // Se il parametro 'rooms' è presente nella richiesta e ha un valore numerico valido
            if ($rooms && is_numeric($rooms)) {
                // Aggiungi una clausola WHERE per filtrare gli appartamenti in base al numero di stanze
                $query->where('rooms', '>=', $rooms);
                // if($rooms >= 5){

                // }else{

                //     $query->where('rooms', '=', $rooms);
                // }
            }
        }

        //filtro stanze da letto
        if($request->has('bedrooms')){
            $bedrooms = $request->input('bedrooms');
            // Se il parametro 'bedrooms' è presente nella richiesta e ha un valore numerico valido
            if ($bedrooms && is_numeric($bedrooms)) {
                // Aggiungi una clausola WHERE per filtrare gli appartamenti in base al numero di stanze
                $query->where('bedrooms', '>=', $bedrooms);
                // if($bedrooms >= 5){

                // }else{
                    
                //     $query->where('bedrooms', '=', $bedrooms);
                // }
            }
        }

        //filtro indirizzo
        if($request->has('address')){
            $address = $request->input('address');       

            // di tutti i record che dammi quelli che includono address anche parzialmente  
            $query->where('address', 'LIKE', '%' . $address . '%');
        }

        if($request->has('distance') ) {

            if($latitude && $longitude) {
                $distance = $request->input('distance');
                $query->whereRaw("ST_Distance_Sphere(point(longitude, latitude), point(?, ?)) <= ?", [$longitude, $latitude, $distance * 1000]);
                $query->orderByRaw("ST_Distance_Sphere(point(longitude, latitude), point($longitude, $latitude)) ASC");
            } 
        }        

        // Ottieni i risultati paginati
        $apartmentsAll = $query->get();
        $apartments = $query->paginate(24);


        $apartmentsWithDistance = [];

        foreach ($apartments as $apartment) {
            $distance = $this->calcolaDistanza($latitude, $longitude, $apartment->latitude, $apartment->longitude);
            $apartment->distance = $distance;
            $apartmentsWithDistance[] = $apartment;
        }
        
        return response()->json([
            'success' => true,
            'apartment' => $apartments,
            'apartmentAll' => $apartmentsAll

        ]);

        // Esempio di query per ottenere gli appartamenti e le relative coordinate geografiche dal database
        

    }

    public function show($slug)
    {
        $apartment = Apartment::with('images', 'services')->where('slug', $slug)->first();

        if($apartment) {

            return response()->json([
                'success' => true,
                'apartment' => $apartment
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => "Non c'è nessun appartamento"
            ])->setStatusCode(404);
        }
    
    }

    private function calcolaDistanza($lat1, $lng1, $lat2, $lng2)
    {
        // Esempio di calcolo della distanza utilizzando la formula dell'emisfero
        // Puoi utilizzare il metodo fornito da Laravel per calcolare la distanza se il database supporta i tipi di dati geografici
        $earthRadius = 6371; // Raggio medio della Terra in km
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);
        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLng / 2) * sin($dLng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distanza = $earthRadius * $c;

        return $distanza;
    }

}