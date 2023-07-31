<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Apartment;
use App\Models\Admin\Service;

class ApartmentServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Apartment::all()->each(function ($apartment) {
            $randomServices = Service::pluck('id')->shuffle()->take(10);
            $apartment->services()->attach($randomServices);
        });
    }
}
