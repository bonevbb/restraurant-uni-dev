<?php

use Illuminate\Database\Seeder;
use App\Menus;
use Faker\Factory as Faker;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Menu products seed with Faker
        $faker = Faker::create();

        foreach (range(1,30) as $index) {
            $menu = new Menus();
            $menu->menu_name = 'Menu' . $index;
            $menu->menu_description = $faker->text;
            $menu->menu_price = $faker->numberBetween(1,10);
            $menu->id_menu_category =  $faker->numberBetween(1,10);
            $menu->stock_qty = $faker->numberBetween(1,10);
            $menu->menu_status = 1;
            $menu->save();
        }
    }
}
