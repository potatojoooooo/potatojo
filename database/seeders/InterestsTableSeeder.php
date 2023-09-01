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
        Interest::create(['name' => 'Badminton', 'category_id' => 1]);
        Interest::create(['name' => 'Golf', 'category_id' => 1]);
        Interest::create(['name' => 'Gym', 'category_id' => 1]);

        Interest::create(['name' => 'Photography', 'category_id' => 2]);
        Interest::create(['name' => 'Art', 'category_id' => 2]);
        Interest::create(['name' => 'Singing', 'category_id' => 2]);

        Interest::create(['name' => 'Museums and galleries', 'category_id' => 3]);
        Interest::create(['name' => 'Cafe hopping', 'category_id' => 3]);
        Interest::create(['name' => 'Karaoke', 'category_id' => 3]);

        Interest::create(['name' => 'Baking', 'category_id' => 4]);
        Interest::create(['name' => 'Board games', 'category_id' => 4]);
        Interest::create(['name' => 'Cooking', 'category_id' => 4]);

        Interest::create(['name' => 'Science fiction', 'category_id' => 5]);
        Interest::create(['name' => 'Anime', 'category_id' => 5]);
        Interest::create(['name' => 'Crime', 'category_id' => 5]);

        Interest::create(['name' => 'Comedy', 'category_id' => 6]);
        Interest::create(['name' => 'History', 'category_id' => 6]);
        Interest::create(['name' => 'Crime', 'category_id' => 6]);

        Interest::create(['name' => 'Blues', 'category_id' => 7]);
        Interest::create(['name' => 'EDM', 'category_id' => 7]);
        Interest::create(['name' => 'Classical', 'category_id' => 7]);

        Interest::create(['name' => 'Bubble tea', 'category_id' => 8]);
        Interest::create(['name' => 'Coffee', 'category_id' => 8]);
        Interest::create(['name' => 'Pizza', 'category_id' => 8]);
    }
}
