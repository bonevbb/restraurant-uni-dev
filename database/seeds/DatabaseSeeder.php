<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        //Users seed with Faker
//        $faker = Faker::create();
//        foreach (range(1,10) as $index) {
//            $user = new User();
//            $user->name = $faker->name;
//            $user->email = $faker->email;
//            $user->password = bcrypt('secret');
//            $user->save();
//        }
    }
}
