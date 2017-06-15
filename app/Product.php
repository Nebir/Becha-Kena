<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id','created_at','updated_at'];

//    public function productCategory()
//    {
//        return $this->belongsTo(Category::class, 'category_id', 'id');
//    }

    public function productOwner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
