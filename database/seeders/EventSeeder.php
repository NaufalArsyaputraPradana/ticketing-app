<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            // Future events (available for purchase)
            [
                'user_id' => 1,
                'judul' => 'Konser Musik Rock',
                'deskripsi' => 'Nikmati malam penuh energi dengan band rock terkenal.',
                'waktu' => '2026-08-15 19:00:00',
                'location_id' => 1,
                'category_id' => 1,
                'gambar' => 'konser_rock.jpg',
            ],
            [
                'user_id' => 1,
                'judul' => 'Pameran Seni Kontemporer',
                'deskripsi' => 'Jelajahi karya seni modern dari seniman lokal dan internasional.',
                'waktu' => '2026-09-10 10:00:00',
                'location_id' => 2,
                'category_id' => 2,
                'gambar' => 'pameran_seni.jpg',
            ],
            [
                'user_id' => 1,
                'judul' => 'Festival Makanan Internasional',
                'deskripsi' => 'Cicipi berbagai hidangan lezat dari seluruh dunia.',
                'waktu' => '2026-10-05 12:00:00',
                'location_id' => 3,
                'category_id' => 3,
                'gambar' => 'festival_makanan.jpg',
            ],
            
            // Expired events (for testing)
            [
                'user_id' => 1,
                'judul' => 'Workshop Fotografi Profesional',
                'deskripsi' => 'Belajar teknik fotografi dari fotografer profesional.',
                'waktu' => '2025-12-20 09:00:00', // Past date
                'location_id' => 1,
                'category_id' => 2,
                'gambar' => 'workshop_foto.jpg',
            ],
            [
                'user_id' => 1,
                'judul' => 'Konser Jazz Malam Tahun Baru',
                'deskripsi' => 'Rayakan tahun baru dengan musik jazz yang merdu.',
                'waktu' => '2025-12-31 20:00:00', // Past date
                'location_id' => 2,
                'category_id' => 1,
                'gambar' => 'konser_jazz.jpg',
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
