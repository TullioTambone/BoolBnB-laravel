<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    protected $table = 'views';

    protected $fillable = [
        'date',
        'ip_address',
    ];

    // collegamento many to one con tabella Apartments
    public function apartment() {
        return $this->belongsTo(Apartment::class);
    }
}