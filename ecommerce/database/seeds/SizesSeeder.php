<?php

use Illuminate\Database\Seeder;
use App\Size;

class SizesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [
            [
                'name' => 'Xs',
            ],
            [
                'name' => 'S',
            ],
            [
                'name' => 'M',
            ],
            [
                'name' => 'L',
            ],
            [
                'name' => 'Xl',
            ],
        ];

        foreach ($sizes as $size) {
            Size::create($size);
        }

    }
}
