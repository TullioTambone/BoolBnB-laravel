<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

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
        'cover',
        'price'
    ];


    //collegamento many to one con tabella Users
    public function user(){
        return $this->belongsTo(User::class);
    }

    //collegamento many to many con tabella Services
    public function services() {
        return $this->belongsToMany(Service::class);
    }

    //collegamento one to many con tabella Images
    public function images() {
        return $this->hasMany(Image::class);
    }
    
    //collegamento one to many con tabella Views
    public function views() {
        return $this->hasMany(View::class);
    }

    //collegamento one to many con tabella Leads
    public function leads() {
        return $this->hasMany(Lead::class);
    }

    //collegamento many to many con tabella Subscriptions
    public function subscriptions() {
        return $this->belongsToMany(Subscription::class);
    }
}
