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

        // Recupera tutti gli appartamenti e ottieni solo gli ID
        $apartmentIds = Apartment::pluck('id')->all();

        // Mescola casualmente gli ID degli appartamenti
        shuffle($apartmentIds);

        // Prendi i primi 100 ID degli appartamenti mescolati
        $selectedApartmentIds = array_slice($apartmentIds, 0, 100);

        // Recupera gli appartamenti corrispondenti agli ID selezionati
        $selectedApartments = Apartment::whereIn('id', $selectedApartmentIds)->get();

        // Per ogni appartamento selezionato
        foreach ($selectedApartments as $apartment) {
            $subscription = Subscription::inRandomOrder()->first();

            if ($subscription) {
                // Calcola l'ora di fine sottoscrizione aggiungendo la duration della sottoscrizione alla data corrente
                $endSubscription = Carbon::now()->addHours($subscription->duration);

                // Associa l'appartamento alla sottoscrizione usando il metodo attach() con la colonna 'result'
                $apartment->subscriptions()->attach($subscription, [
                    'end_subscription' => $endSubscription
                ]);
            }
        }
    }
}
