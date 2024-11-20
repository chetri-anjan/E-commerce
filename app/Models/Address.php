<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'country',
        'state',
        'city',
        'postal_code', 
        'street_no',
        'house_no',
        'location' 
    ];

    function countries()
    {
        return $this->belongsTo(Country::class);
    }
    
}
