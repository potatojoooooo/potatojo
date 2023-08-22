<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\User;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $creator = User::first();

        Event::create([
            'name' => 'Sample Event',
            'description' => 'Sample description description description',
            'location' => 'Sample location location location',
            'date' => '2023-08-25',
            'start_time' => '14:00:00',
            'end_time' => '18:00:00',
            'longitude' => 101.797,
            'latitude' => 3.036,
            'participants_needed' => 20,
            'user_id' => $creator->id,
            // Other event-related fields
        ]);
    }
}
