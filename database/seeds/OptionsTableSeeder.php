<?php

use Illuminate\Database\Seeder;
use App\Options;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Options::create([
            'name' => 'доматен сос',
        ]);
        Options::create([
            'name' => 'лук',
        ]);
        Options::create([
            'name' => 'царевица',
        ]);
        Options::create([
            'name' => 'сол',
        ]);
        Options::create([
            'name' => 'черен пипер',
        ]);
        Options::create([
            'name' => 'грах',
        ]);
        Options::create([
            'name' => 'кашкавал',
        ]);
        Options::create([
            'name' => 'кетчуп',
        ]);
        Options::create([
            'name' => 'майонеза',
        ]);
        Options::create([
            'name' => 'яйце',
        ]);
        Options::create([
            'name' => 'сос',
        ]);
    }
}
