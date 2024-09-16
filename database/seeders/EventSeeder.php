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
        Event::create([
            'name' => 'Concert de Jazz',
            'description' => 'Un concert de jazz avec des artistes locaux.',
            'date' => '2024-10-01',
            'price' => 15000,
            'available_tickets' => 100,
        ]);

      
        Event::create([
            'name' => 'Concert Welove Eya',
            'description' => 'Un concert pour enjailler les vacances.',
            'date' => '2025-04-03',
            'price' => 2500,
            'available_tickets' => 500,
        ]);

        
        Event::create([
            'name' => 'Conférence Tech',
            'description' => 'Une conférence sur les dernières innovations technologiques.',
            'date' => '2024-09-15',
            'price' => 10000,
            'available_tickets' => 200,
        ]);
    }
}