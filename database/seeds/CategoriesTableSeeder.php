<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Categories;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Users seed with Faker
        $faker = Faker::create();

        foreach (range(1,10) as $index) {
            $category = new Categories();
            $category->name = 'Category ' . $index;
            $category->description = $faker->text;
            $category->id_parent = 0;
            $category->status = 1;
            $category->save();
        }
    }
}
