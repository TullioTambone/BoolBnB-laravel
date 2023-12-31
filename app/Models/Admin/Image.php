<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'url',
        'apartment_id'
    ];

    // collegamento many to one con tabella Apartments
    public function apartment() {
        return $this->belongsTo(Apartment::class);
    }
}
