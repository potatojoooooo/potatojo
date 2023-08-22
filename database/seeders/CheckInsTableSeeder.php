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
        $user = User::first();

        CheckIn::create([
            'user_id' => $user->id,
            'location' => 'somewhere',
            'check_in_time' => now(),
            'check_in_notes' => 'Sample check-in',
        ]);
    }
}
