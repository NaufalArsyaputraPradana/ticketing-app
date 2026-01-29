<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            UserSeeder::class,
            LocationSeeder::class,
            EventSeeder::class,
            TiketTypeSeeder::class,
            TicketSeeder::class,
            PaymentSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
