<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Apartment;
use App\Models\Admin\Subscription;
use Carbon\Carbon;

class ApartmentSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Recupera tutti gli appartamenti
        $apartments = Apartment::all();
        
        // Seleziona casualmente un appartamento tra tutti gli appartamenti disponibili
        $randomApartment = $apartments->random();

        // Verifica se l'appartamento selezionato casualmente esiste
        if ($randomApartment) {
            $subscription = Subscription::inRandomOrder()->first();

            if ($subscription) {
                // Calcola l'ora di fine sottoscrizione aggiungendo la duration della sottoscrizione alla data corrente
                $endSubscription = Carbon::now()->addHours($subscription->duration);

                // Calcola la somma della duration della sottoscrizione con la data corrente
                $result = $endSubscription->addHours($subscription->duration)->format('Y-m-d H:i:s');

                // Associa l'appartamento alla sottoscrizione usando il metodo attach() con la colonna 'result'
                $randomApartment->subscriptions()->attach($subscription, [
                    'end_subscription' => $endSubscription
                ]);
            }
        }
    }
}
