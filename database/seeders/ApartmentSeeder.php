<?php

namespace Database\Seeders;

use App\Functions\Helpers;
use App\Models\Apartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = include database_path('../config/data.php');
        $newApartments = [];
        foreach ($apartments as $key => $apartment) {
            $apartment['slug'] = Helpers::generateSlug($apartment['title']);
            $newApartments[] = $apartment;
        }
        Apartment::insert($newApartments);
    }
}
