<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Interest;

class InterestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $interests = [
            'Sports',
            'Photography',
            'Art',
            'Singing',
            'Cafe-hopping',
            'Museums and galleries',
            'Video games',
            'Sci-fi film',
            'Anime',
            'Coffee',
            'Bubble tea',
            'Board games',
            'Cats',
            'Dogs',
        ];

        foreach ($interests as $interest) {
            Interest::create([
                'interest' => $interest,
            ]);
        }
    }
}
