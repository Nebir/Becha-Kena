<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
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

        $userIds = App\User::get()->pluck('id')->toArray();

        foreach ($userIds as $customerId) {
            $orderNumber = rand(1,3);
            for ($i=0; $i < $orderNumber ; $i++) {
                $o = new App\Order();
                $o->customer_id = $customerId;
                $o->total_price	= $faker->numberBetween($min = 100, $max = 20000);
                $o->save();
            }
        }
    }
}
