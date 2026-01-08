<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;

    // ensure this model maps to the `products` table
    protected $table = 'products';

    protected $fillable = ['name', 'description', 'price', 'category', 'image', 'status'];

    /**
     * Scope a query to only include active products.
     */
    public function scopeActive(Builder $query)
    {
        return $query->where('status', 'active');
    }
}
