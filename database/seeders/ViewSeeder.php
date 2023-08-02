<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Lead;
use App\Models\Admin\Apartment;
use App\Models\User;
use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $faker = FakerFactory::create('it_IT');
        // $new_apartment = new Apartment();
        $new_user = new User();
        $apartments = [];
        $users = [];
        $userIdCounter = 1;

        $images = config('images');
        $titles = config('titles');
        $descriptions = config('phrases');
        $totalImages = count($images);
        $totalTitles = count($titles);
        $totalDescription = count($descriptions);

        for ($i = 0; $i < 200; $i++) {
            $imageIndex = $i % $totalImages; 
            $titleIndex = $i % $totalTitles;
            $descriptionIndex = $i % $totalDescription;
            $price = round(rand(100, 500));
            $user_id = $faker->numberBetween(1, 50);
            $title = $titles[$titleIndex];

            $apartments[] = [
                'user_id' => 1,
                'title' => $title,
                'rooms' => $faker->numberBetween(1, 5),
                'bedrooms' => $faker->numberBetween(1, 5),
                'bathrooms' => $faker->numberBetween(1, 5),
                'square_meters' => $faker->numberBetween(50, 200),
                'address' => $faker->unique()->address(),
                'visibility' => $faker->numberBetween(0, 1),
                'vote' => $faker->numberBetween(3, 5),
                'slug' => Apartment::toSlug($title, $i),
                'longitude' => null,
                'latitude' => null, 
                'description' => $descriptions[$descriptionIndex],
                'price' => $price,
                'cover' => $images[$imageIndex],
            ];

            // Ottieni l'indirizzo generato usando Faker
            $address = $apartments[$i]['address'];

            // Divide l'indirizzo in diverse parti per filtrarlo
            $addressParts = explode(",", $address);

            // Effettua la chiamata API al servizio di reverse geocoding di TomTom per ottenere le coordinate
            $apiKey = '74CVsbN34KoIljJqOriAYN2ZMEYU1cwO';
            $versionNumber = '2';
            $latitude = null;
            $longitude = null;

            foreach ($addressParts as $part) {
                // Rimuovi eventuali spazi vuoti all'inizio e alla fine di ogni parte
                $part = trim($part);
                // Ignora eventuali parti che contengono solo numeri (potrebbero essere codici postali)
                if (!is_numeric($part)) {
                    // Effettua la chiamata API al servizio di reverse geocoding di TomTom per ottenere le coordinate
                    $query = urlencode($part); // Codifica la parte dell'indirizzo per l'URL
                    $url = "https://api.tomtom.com/search/{$versionNumber}/geocode/{$query}.json?key={$apiKey}";

                    $client = new Client([
                        'verify' => false,
                    ]);

                    try {
                        $response = $client->get($url);
                        $data = json_decode($response->getBody(), true);

                        // Verifica se sono stati ottenuti dei risultati validi
                        if (isset($data['results']) && !empty($data['results'])) {
                            // Ottieni le coordinate dalla risposta API
                            $latitude = $data['results'][0]['position']['lat'];
                            $longitude = $data['results'][0]['position']['lon'];
                            break; // Esci dal ciclo se almeno una parte ha prodotto risultati validi
                        }
                    } catch (Exception $e) {
                        // Gestisci eventuali errori nell'effettuare la chiamata API
                    }
                }
            }

            // Aggiungi le coordinate ottenute da TomTom all'array di appartamenti
            $apartments[$i]['latitude'] = $latitude;
            $apartments[$i]['longitude'] = $longitude;
        }
        // $users[] = [
        //     'name' => $faker->unique()->name(),
        //     'surname' => $faker->unique()->lastname(),
        //     'birthday' => $faker->date(),
        //     'email' => $faker->unique()->email(),
        //     'password' => $faker->unique()->password(),
        // ];

        $jsonArray = json_encode($apartments, JSON_PRETTY_PRINT);
        $phpArray = "<?php\n\nreturn " . $jsonArray . ";";
        File::put(config_path('apart.php'), $phpArray);
    }
}
