<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'category', 'image', 'status'];

    /**
     * Scope a query to only include active menus.
     */
    public function scopeActive(Builder $query)
    {
        return $query->where('status', 'active');
    }
}