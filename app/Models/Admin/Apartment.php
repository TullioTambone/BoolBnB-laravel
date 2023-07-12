<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//import del Model per percorso differente 
use App\Models\User;

class Apartment extends Model
{
    use HasFactory;

    protected $table = 'apartments';


    //collegamento one to many con Model User
    public function user(){
        return $this->hasMany(User::class);
    }
}
