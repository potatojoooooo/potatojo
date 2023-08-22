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
        $user = User::first();
        $event = Event::first();

        DB::table('event_participants')->insert([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'participation_status' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
