<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\Subscription;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //2023-07-24 12:30:00
        $subscriptions = [
            [
                'name' => 'Base',
                'price' => 2.99,
                'duration' => '24',
            ],
            [
                'name' => 'Premium',
                'price' => 5.99,
                'duration' => '72',
            ], 
            [
                'name' => 'Platino',
                'price' => 9.99,
                'duration' => '144',
            ]
        ];

        foreach ($subscriptions as $element) {
  
            $new_sub = new Subscription();
            $new_sub->name = $element['name'];
            $new_sub->price = $element['price'];
            $new_sub->duration = $element['duration'];
            $new_sub->save();
        }

    }
}
