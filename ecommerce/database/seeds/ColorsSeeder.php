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
            ],
            [
                'name' => 'Black',
            ],
            [
                'name' => 'Red',
            ],
            [
                'name' => 'Orange',
            ],
            [
                'name' => 'Yellow',
            ],
            [
                'name' => 'Green',
            ],
            [
                'name' => 'Blue',
            ],
            [
                'name' => 'Indigo',
            ],
            [
                'name' => 'Violet',
            ],
        ];

        foreach ($colors as $color) {
            Color::create($color);
        }
    }
}
