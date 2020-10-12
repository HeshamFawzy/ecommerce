<?php

use App\Part;
use Illuminate\Database\Seeder;

class PartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parts = [
            [
                'name' => 'Chest',
            ],
            [
                'name' => 'Waist',
            ],
            [
                'name' => 'Regular',
            ],
            [
                'name' => 'Inseam',
            ],
            [
                'name' => 'Long(Tall) Inseam',
            ],
        ];

        foreach ($parts as $part) {
            Part::create($part);
        }
    }
}
