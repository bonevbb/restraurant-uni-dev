<?php

use Illuminate\Database\Seeder;
use App\Allergens;

class AllergensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Allergens::create([
            'name' => 'Зърнени култури, съдържащи глутен',
        ]);
        Allergens::create([
            'name' => 'Ракообразни и продукти от тях',
        ]);
        Allergens::create([
            'name' => 'Яйца и продукти от тях',
        ]);
        Allergens::create([
            'name' => 'Риба и рибни продукти',
        ]);
        Allergens::create([
            'name' => 'Фътъци и продукти от тях',
        ]);
        Allergens::create([
            'name' => 'Соя и соеви продукти',
        ]);
        Allergens::create([
            'name' => 'Мляко и млечни продукти',
        ]);
        Allergens::create([
            'name' => 'Ядки',
        ]);
        Allergens::create([
            'name' => 'Цялина и продукти от нея',
        ]);
        Allergens::create([
            'name' => 'Синап и синапено семе(горчица)',
        ]);
        Allergens::create([
            'name' => 'Сусамово семе и продукти от него',
        ]);
        Allergens::create([
            'name' => 'Мекотели и продукти от тях',
        ]);
        Allergens::create([
            'name' => 'Целина и продукти от нея',
        ]);
        Allergens::create([
            'name' => 'Серен диокид и сулфати',
        ]);
    }
}
