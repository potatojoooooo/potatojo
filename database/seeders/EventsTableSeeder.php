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

        Event::create([
            'name' => 'Badminton',
            'description' => '',
            'location' => 'Sports Arena',
            'city' => 'Bangsar',
            'date' => '2023-08-25',
            'start_time' => '14:00:00',
            'end_time' => '18:00:00',
            'longitude' => 101.67978380,
            'latitude' => 3.12901000,
            'participants_needed' => 20,
            'user_id' => 1,
        ]);

        Event::create([
            'name' => 'Taking Merdeka photos',
            'description' => 'finding team members',
            'location' => 'Dataran Merdeka',
            'city' => 'Klang',
            'date' => '2023-08-25',
            'start_time' => '14:00:00',
            'end_time' => '18:00:00',
            'longitude' => 101.44556210,
            'latitude' => 3.04491700,
            'participants_needed' => 20,
            'user_id' => 2,
        ]);

        Event::create([
            'name' => 'Visit galleries',
            'description' => '',
            'location' => 'National Art Gallery',
            'city' => 'Kuala Lumpur',
            'date' => '2023-08-25',
            'start_time' => '14:00:00',
            'end_time' => '18:00:00',
            'longitude' => 101.79700000,
            'latitude' => 3.03600000,
            'participants_needed' => 2,
            'user_id' => 3,
        ]);

        Event::create([
            'name' => 'Any Kluangrians',
            'description' => 'Car pool togther',
            'location' => 'Kluang',
            'city' => 'Kluang',
            'date' => '2023-08-25',
            'start_time' => '14:00:00',
            'end_time' => '18:00:00',
            'longitude' => 103.31850000,
            'latitude' => 2.03010000,
            'participants_needed' => 4,
            'user_id' => 4,
        ]);

        Event::create([
            'name' => 'Cafe-hopping',
            'description' => 'Visit cafes round PAsar Seni areas',
            'location' => 'PasarSeni',
            'city' => 'Petaling Jaya',
            'date' => '2023-08-25',
            'start_time' => '14:00:00',
            'end_time' => '18:00:00',
            'longitude' => 101.78821690,
            'latitude' => 3.04105800,
            'participants_needed' => 4,
            'user_id' => 5,
        ]);
    }
}
