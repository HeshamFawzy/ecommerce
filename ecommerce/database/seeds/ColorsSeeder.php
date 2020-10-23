<?php

use Illuminate\Database\Seeder;
use App\Color;

class ColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            [
                'name' => 'White',
                'name_ar' => 'أبيض'
            ],
        ];

        foreach ($colors as $color) {
            Color::create($color);
        }
    }
}
