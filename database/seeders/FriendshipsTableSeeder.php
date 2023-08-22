<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class FriendshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::first();
        $user2 = User::find(2); // Replace with the desired user

        DB::table('friendships')->insert([
            'user_id_1' => $user1->id,
            'user_id_2' => $user2->id,
            'friendship_status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create more friendships as needed
    }
}
