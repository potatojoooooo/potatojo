<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CheckIn;
use App\Models\User;

class CheckInsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::whereIn('id', [1, 2, 3, 4, 5, 6])->get(); // Replace with desired user IDs

        foreach ($users as $user) {
            CheckIn::create([
                'user_id' => $user->id,
                'location' => 'somewhere',
                'check_in_notes' => 'Sample check-in',
                'longitude' => 101.93800000,
                'latitude' => 2.72970000
            ]);
        }
    }
}
