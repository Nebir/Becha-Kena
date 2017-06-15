<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
        for ($i=1,$c=1; $i < 50; $i++)
        {
            $u = new App\User();
            $u->name = $faker->name;
            $u->email = $faker->email;
            $u->password = bcrypt(1);
            $u->department = $faker->words($nb = 3, $asText = true);
            $u->reg_no = $faker->numberBetween($min = 20100, $max = 20900);
            $u->contact_no = $faker->e164PhoneNumber;
            $u->address = $faker->address;
            if ($i == 1) {
                $u->role = 'Admin';
            }
            elseif ($i % 4 == 0 ) {
                $u->role = 'Owner';
            }
            else {
                $u->role = 'Public';
            }
            $u->image = $faker->imageUrl($width = 640, $height = 480);
            $u->status = 1;


            $u->save();
        }
    }
}
