<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Lead;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContact;



class LeadController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        // validazione

        // salvataggio dei dati nel db
        $new_lead = Lead::create($data);

        // invio mail
        Mail::to('no-replay@boolpress.it')->send( new NewContact($new_lead) );

        // ottenere la risposta in json
        return response()->json(
            [  
                'success' => true
            ]
        );
    }
}
