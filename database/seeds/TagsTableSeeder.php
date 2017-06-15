<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
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
        for ($i=1; $i < 50; $i++)
        {
            $t = new App\Tag();
            $t->name = $faker->name;
            $t->save();
        }
    }
}
