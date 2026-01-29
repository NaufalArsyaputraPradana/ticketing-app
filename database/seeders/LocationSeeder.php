<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $locations = [
            ['name' => 'Stadion Utama'],
            ['name' => 'Galeri Seni Kota'],
            ['name' => 'Ruang Seminar A'],
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
