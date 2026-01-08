<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['nota', 'customer_name', 'email', 'phone', 'address', 'total', 'status', 'payment_method', 'notes'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
