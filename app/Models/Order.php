<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'status',
    'total',
    'shipping_name',
    'shipping_address',
    'shipping_city',
    'shipping_postal_code',
    'shipping_country',
    'shipping_phone',
    'billing_name',
    'billing_address',
    'billing_city',
    'billing_postal_code',
    'billing_country',
    'billing_phone',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}