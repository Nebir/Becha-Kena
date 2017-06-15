<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    //
    protected $table = "product_tag";

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
