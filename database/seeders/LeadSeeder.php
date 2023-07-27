<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Apartment;
use App\Models\Admin\Lead;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ottieni tutti gli appartamenti disponibili
        $apartments = Apartment::all();

        // Popola la tabella "lead" con dati casuali
    //     foreach ($apartments as $apartment) {
    //         Lead::create([
    //             'name' => $faker->name,
    //             'email' => $faker->email,
    //             'message' => $faker->paragraph,
    //             'apartment_id' => $apartment->id,
    //         ]);
    //     }
    }
}
