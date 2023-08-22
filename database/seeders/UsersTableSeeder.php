<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'john_doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'bio' => 'hahahahahahaha',
            'allow_location_sharing' => true,
            // Other user-related fields
        ]);

        User::create([
            'name' => 'joanne_doe',
            'email' => 'joanne@example.com',
            'password' => "1234567890",
            'bio' => 'hahahahahahaha',
            'allow_location_sharing' => false,
            // Other user-related fields
        ]);

        User::create([
            'name' => 'testing',
            'email' => 'testing@example.com',
            'password' => "1234567890",
            'bio' => 'long paragraph long paragraph long paragraph long paragraph long paragraph',
            'allow_location_sharing' => true,
            // Other user-related fields
        ]);

        User::create([
            'name' => 'sam',
            'email' => 'sam@example.com',
            'password' => "1234567890",
            'bio' => 'some long paragaph for bio',
            'allow_location_sharing' => false,
            // Other user-related fields
        ]);

        User::create([
            'name' => 'lee',
            'email' => 'lee@example.com',
            'password' => "1234567890",
            'bio' => 'this is lee lee lee lee lee lee lee lee',
            'allow_location_sharing' => true,
            // Other user-related fields
        ]);
    }
}
