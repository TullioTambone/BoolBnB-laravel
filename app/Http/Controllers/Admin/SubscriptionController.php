<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Apartment;
use App\Models\Admin\Subscription;
use Illuminate\Http\Request;
use Braintree\Gateway;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function token(Request $request)
    {
        $sub = Subscription::all();
        // Ottieni l'appartamento corrispondente all'ID nel campo nascosto 'apartment_id'
        $apartment = Apartment::findOrFail($request->input('apartment_id'));

        // Ottieni la sottoscrizione corrispondente all'ID nel campo nascosto 'subscription_id'
        $subscription = Subscription::where('id', $request->input('subscription_id'))->first();

        if ($subscription) {
            // Calcola l'ora di fine sottoscrizione aggiungendo la durata della sottoscrizione all'ora corrente
            $endSubscription = Carbon::now()->addHours($subscription->duration);
    
            // Associa l'appartamento alla sottoscrizione usando il metodo attach()
            $apartment->subscriptions()->attach($subscription, [
                'end_subscription' => $endSubscription,
            ]);
        }

        $nonceFromTheClient = $request->input('payment_method_nonce');
    
        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env("BRAINTREE_MERCHANT_ID"),
            'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
            'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        ]);
        $clientToken = $gateway->clientToken()->generate();
        
        $results = $gateway->transaction()->sale([
            'amount' => $subscription->price,
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => [
                'submitForSettlement' => true
            ],
            "customer" => [
                "id" => $apartment->user->id,
                "firstName" => $apartment->user->name,
                "lastName" => $apartment->user->surname,
                "company" => 'Boolean',
                "email" => $apartment->user->email,
                "website" => null,
                "phone" => null,
                "fax" => null
            ]
        ]);
        
        return view('admin.show', compact('apartment', 'sub', 'results', 'clientToken'));
        // return redirect()->route('admin.index')->with([
        //     'results' => $results
        // ]);
    }
    
    

    // public function process(Request $request)
    // {
    //     $payload = $request->input('payload', false);
    //     $nonce = $payload['nonce'];

    //     $status = Transaction::sale([
    //         'amount' => '10.00',
    //         'paymentMethodNonce' => $nonce,
    //         'options' => [
    //             'submitForSettlement' => True
    //         ]
    //     ]);

    //     return response()->json($status);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('admin.subscription');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
