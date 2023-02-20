<?php

namespace Database\Seeders;

use App\Models\Sponsorship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorships = [
            [
                'name' => 'Bronze',
                'price' => 2.99,
                'duration_hours' => 24,
            ],
            [
                'name' => 'Silver',
                'price' => 5.99,
                'duration_hours' => 72,
            ],
            [
                'name' => 'Gold',
                'price' => 9.99,
                'duration_hours' => 144,
            ]
        ];
        foreach ($sponsorships as $sponsorship) {
            $new_sponsorship = new Sponsorship();
            $new_sponsorship->name = $sponsorship['name'];
            $new_sponsorship->price = $sponsorship['price'];
            $new_sponsorship->duration_hours = $sponsorship['duration_hours'];
            $new_sponsorship->save();
        }
    }
}
