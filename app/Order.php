<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public function orderProductItems()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }



    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id', 'id');
    }
}
