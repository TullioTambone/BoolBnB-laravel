<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartment = Apartment::all();
        

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