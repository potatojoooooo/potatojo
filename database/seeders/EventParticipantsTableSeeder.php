<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Event;

class EventParticipantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::whereIn('id', [1, 2, 3])->get(); // Replace with desired user IDs
        $events = Event::whereIn('id', [1, 2])->get(); // Replace with desired event IDs

        foreach ($users as $user) {
            foreach ($events as $event) {
                DB::table('event_participants')->insert([
                    'user_id' => $user->id,
                    'event_id' => $event->id,
                    'participation_status' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
