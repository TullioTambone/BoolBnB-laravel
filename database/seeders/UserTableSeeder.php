<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = config('users');

       // qui abbiamo ciclato l'array e assegnato i valori delle chiavi alle colonne della tabella Services
       foreach ($users as $element) {
           $new_apartments = new User();
           $new_apartments->name = $element['name'];
           $new_apartments->surname = $element['surname'];
           $new_apartments->birthday = $element['birthday'];
           $new_apartments->email = $element['email'];
           $new_apartments->password = $element['password'];
           $new_apartments->save();
       }
    }
}
