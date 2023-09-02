<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(CategorySeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(InterestsTableSeeder::class);
        $this->call(FriendshipsTableSeeder::class);
        $this->call(CheckInsTableSeeder::class);
        $this->call(UserInterestsTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(EventParticipantsTableSeeder::class);
    }
}
