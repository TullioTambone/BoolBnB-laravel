<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';

    protected $fillable = [
        'name',
        'price',
        'duration'
    ];

    //collegamento many to many con tabella Apartments
    public function apartments() {
        return $this->belongsToMany(Apartment::class);
    }
}
