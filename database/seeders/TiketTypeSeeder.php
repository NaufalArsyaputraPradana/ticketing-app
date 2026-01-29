<?php

namespace Database\Seeders;

use App\Models\TicketType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TiketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $typetickets = [
            ['name' => 'Reguler'],
            ['name' => 'Premium'],
            ['name' => 'VIP'],
        ];

        foreach ($typetickets as $ticket) {
            TicketType::create($ticket);
        }
    }
}
