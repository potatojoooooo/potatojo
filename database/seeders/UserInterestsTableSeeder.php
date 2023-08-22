<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Interest;

class UserInterestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $interests = Interest::take(5)->get();

        foreach ($users as $user) {
            foreach ($interests as $interest) {
                DB::table('user_interests')->insert([
                    'user_id' => $user->id,
                    'interest_id' => $interest->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
