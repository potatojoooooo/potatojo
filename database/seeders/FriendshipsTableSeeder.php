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
        $users = User::whereIn('id', [1, 2, 3, 4, 7, 8, 9])->get();

        foreach ($users as $user1) {
            foreach ($users as $user2) {
                if ($user1->id !== $user2->id) {
                    DB::table('friendships')->insert([
                        'user_id_1' => $user1->id,
                        'user_id_2' => $user2->id,
                        'friendship_status' => 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
