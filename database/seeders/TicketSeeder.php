<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tickets = [
            // Event 1: Konser Musik Rock (Future - Available stock)
            [
                'event_id' => 1,
                'type' => 'premium',
                'harga' => 1500000,
                'stok' => 100,
            ],
            [
                'event_id' => 1,
                'type' => 'reguler',
                'harga' => 500000,
                'stok' => 500,
            ],
            
            // Event 2: Pameran Seni Kontemporer (Future - Available stock)
            [
                'event_id' => 2,
                'type' => 'premium',
                'harga' => 200000,
                'stok' => 300,
            ],
            
            // Event 3: Festival Makanan Internasional (Future - Sold out for testing)
            [
                'event_id' => 3,
                'type' => 'premium',
                'harga' => 300000,
                'stok' => 0, // SOLD OUT for testing
            ],
            [
                'event_id' => 3,
                'type' => 'reguler',
                'harga' => 150000,
                'stok' => 0, // SOLD OUT for testing
            ],
            
            // Event 4: Workshop Fotografi (Expired - Available stock)
            [
                'event_id' => 4,
                'type' => 'premium',
                'harga' => 500000,
                'stok' => 50,
            ],
            [
                'event_id' => 4,
                'type' => 'reguler',
                'harga' => 250000,
                'stok' => 100,
            ],
            
            // Event 5: Konser Jazz (Expired - Sold out)
            [
                'event_id' => 5,
                'type' => 'premium',
                'harga' => 1000000,
                'stok' => 0, // SOLD OUT for testing
            ],
            [
                'event_id' => 5,
                'type' => 'reguler',
                'harga' => 400000,
                'stok' => 0, // SOLD OUT for testing
            ],
        ];

        foreach ($tickets as $ticket) {
            Ticket::create($ticket);
        }
    }
}
