<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'image',
        'product_name',
        'description', 
        'quantity',
        'price',
        'size',
        'stock'
    ];

    function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    function users()
    {
        return $this->belongsTo(User::class);
    }
    function carts()
    {
        return $this->hasMany(Cart::class);
    }
    function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
    function order()
    {
        return $this->hasMany(Order::class);
    }

    function rating()
    {
        return $this->hasMany(Rating::class);
    }

    public function averageRating()
{
    return $this->rating()->avg('rating');
}
    
    
}

