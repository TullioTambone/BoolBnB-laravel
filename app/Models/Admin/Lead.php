<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $table = 'leads';

    protected $fillable = [
        'name',
        'email',
        'message',
        'apartment_id'
    ];

    // collegamento many to one con tabella Apartments
    public function apartment() {
        return $this->belongsTo(Apartment::class);
    }
}
