<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
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
        for ($i=1; $i < 11; $i++) {
            $c = new App\Category();
            $c->name = $faker->name;
            $c->image = $faker->imageUrl($width = 640, $height = 480);
            $c->parent_id = $faker->numberBetween($min = 1, $max = 10);
            $c->save();
        }
    }
}
