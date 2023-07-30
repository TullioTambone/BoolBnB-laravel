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
        $new_apartment = new Apartment();
        $new_user = new User();
        $apartments = [];
        $users = [];
        $userIdCounter = 1;

        $images = config('images');
        $totalImages = count($images);

        for ($i = 0; $i < 50; $i++) {
            $imageIndex = $i % $totalImages; 
            $price = round(rand(100000, 5000000) / 1000) * 1000;
            $apartments[] = [
                'user_id' => $faker->numberBetween(1, 50),
                'title' => $faker->sentence(),
                'rooms' => $faker->numberBetween(1, 5),
                'bedrooms' => $faker->numberBetween(1, 3),
                'bathrooms' => $faker->numberBetween(1, 2),
                'square_meters' => $faker->numberBetween(50, 200),
                'address' => $faker->unique()->address(),
                'visibility' => $faker->numberBetween(0, 1),
                'vote' => $faker->numberBetween(3, 5),
                'slug' => $faker->unique()->slug(),
                'longitude' => $faker->longitude(),
                'latitude' => $faker->latitude(), 
                'description' => $faker->paragraph(),
                'price' => $price,
                'cover' => $images[$imageIndex],
            ];
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
