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
            'password' => Hash::make('password'),
            'bio' => 'hahahahahahaha',
            'allow_location_sharing' => false,
            // Other user-related fields
        ]);
    }
}
