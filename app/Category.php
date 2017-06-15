<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //


    function productCategory()
    {
        //return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
