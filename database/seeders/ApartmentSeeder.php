<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Apartment;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // qui abbiamo assegnato alla variabile $services l'array contenuto nel file 'servicesTable
       $apartments = config('apartments');

       // qui abbiamo ciclato l'array e assegnato i valori delle chiavi alle colonne della tabella Services
       foreach ($apartments as $element) {
           $new_apartments = new Apartment();
           $new_apartments->user_id = $element['user_id'];
           $new_apartments->title = $element['title'];
           $new_apartments->rooms = $element['rooms'];
           $new_apartments->bedrooms = $element['bedrooms'];
           $new_apartments->bathrooms = $element['bathrooms'];
           $new_apartments->square_meters = $element['square_meters'];
           $new_apartments->address = $element['address'];
           $new_apartments->visibility = $element['visibility'];
           $new_apartments->slug = $element['slug'];
           $new_apartments->longitude = $element['longitude'];
           $new_apartments->latitude = $element['latitude'];
           $new_apartments->description = $element['description'];
           $new_apartments->price = $element['price'];
           $new_apartments->cover = $element['cover'];
           $new_apartments->save();
       }
    }
}