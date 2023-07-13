<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

//import del Model per percorso differente 
use App\Models\User;

class Apartment extends Model
{
    use HasFactory;

    public static function toSlug($title) {
        return Str::slug($title, '-');
    }

    protected $table = 'apartments';

    protected $fillable = [
        'user_id',
        'title',
        'rooms',
        'bedrooms',
        'bathrooms',
        'square_meters',
        'address',
        'visibility',
        'slug',
        'longitude',
        'latitude',
        'description',
        'cover'
    ];


    //collegamento one to many con Model User
    public function user(){
        return $this->belongsTo(User::class);
    }
}
