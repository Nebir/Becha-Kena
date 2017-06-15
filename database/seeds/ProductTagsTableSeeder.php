<?php

use Illuminate\Database\Seeder;

class ProductTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     *
     */
    public function run()
    {
        //
        /*$product = \App\Product::first();
        $product->tags()->attach([1,2,3]);*/
        $productIds = App\Product::get()->pluck('id')->toArray();
        $tagIds = App\Tag::get();

        foreach ($productIds as $productId) {
            $tagNumber = rand(1,4);
            for ($i=0; $i < $tagNumber ; $i++) {
                $pt = new App\ProductTag();
                $tag = $tagIds->random();
                $pt->product_id = $productId;
                $pt->tag_id = $tag->id;
                $pt->save();
            }
        }
    }
}
