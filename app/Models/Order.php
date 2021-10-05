<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Address;
use App\Models\OrderProduct;

class Order extends Model
{
    use HasFactory;

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }
    public function order_products()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }
}
