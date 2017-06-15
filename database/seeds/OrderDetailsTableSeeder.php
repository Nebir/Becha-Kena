<?php

use Illuminate\Database\Seeder;

class OrderDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create();

        $orderIds = App\Order::get()->pluck('id')->toArray();
        $productItems = App\Product::get();

        foreach ($orderIds as $orderId) {
            $od = new App\OrderDetail();
            $productItem = $productItems->random();
            $od->order_id = $orderId;
            $od->product_id = $productItem->id;
            $od->quantity = $faker->numberBetween($min = 1, $max = 3);
            $od->unit_price = $productItem->unit_price;
            $od->total_price = $faker->numberBetween($min = 100, $max = 10000);
            $od->status = $faker->boolean;
            $od->save();
        }
    }
}
