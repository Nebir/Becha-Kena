<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
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

        $userIds = App\User::get();
        $categoryIds = App\Category::get()->pluck('id')->toArray();


        foreach ($categoryIds as $categoryId) {
            for ($i=1; $i < 2; $i++)
            {
                $p = new App\Product();
                $owner = $userIds->random();
                $p->name = $faker->hexcolor;
                $p->image = $faker->imageUrl($width = 640, $height = 480);
                $p->description = $faker->paragraph($nbSentences = 3, $variableNbSentences = true);
                $p->unit_price = $faker->numberBetween($min = 100, $max = 10000);
                $p->available_quantity = $faker->numberBetween($min = 0, $max = 50);
                $p->category_id = $categoryId;
                $p->owner_id = $owner->id;
                $p->status = $faker->boolean;
                $p->save();
            }
        }


    }
}
