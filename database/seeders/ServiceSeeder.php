<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // qui abbiamo assegnato alla variabile $services l'array contenuto nel file 'servicesTable
        $services = config('servicesTable');

        // qui abbiamo ciclato l'array e assegnato i valori delle chiavi alle colonne della tabella Services
        foreach ($services as $element) {
            $new_service = new Service();
            $new_service->name = $element['name'];
            $new_service->icon = $element['icon'];
            $new_service->save();
        }
    }
}
