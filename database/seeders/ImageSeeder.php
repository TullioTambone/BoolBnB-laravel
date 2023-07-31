<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Image;
use App\Models\Admin\Apartment;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = config('images');
        $numImagesPerApartment = 10; // Numero desiderato di immagini per ogni appartamento

        // Mescola l'array degli URL delle immagini in modo casuale
        shuffle($images);

        // Recupera tutti gli appartamenti
        $apartments = Apartment::all();

        // Per ogni appartamento
        foreach ($apartments as $apartment) {
            // Prendi solo i primi 10 URL delle immagini mescolate per l'appartamento corrente
            $randomImageUrls = array_slice($images, 0, $numImagesPerApartment);

            // Assegna gli URL delle immagini all'appartamento
            foreach ($randomImageUrls as $imageUrl) {
                $image = new Image();
                $image->apartment_id = $apartment->id;
                $image->url = $imageUrl;
                $image->save();
            }
        }
    }
}
