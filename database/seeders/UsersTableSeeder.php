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
            'name' => 'john doe',
            'email' => 'john@1utar.my',
            'password' => bcrypt("12345678"),
            'bio' => 'hahahahahahaha',
            'allow_location_sharing' => true,
            'role' => 0
        ]);

        User::create([
            'name' => 'nicole',
            'email' => 'nicole@1utar.my',
            'password' => bcrypt("12345678"),
            'bio' => 'nicole!',
            'allow_location_sharing' => true,
            'role' => 0
        ]);

        User::create([
            'name' => 'joanne',
            'email' => 'joanne0611@1utar.my',
            'password' => bcrypt("12345678"),
            'bio' => 'hahahahahahaha',
            'allow_location_sharing' => false,
            'role' => 0
        ]);

        User::create([
            'name' => 'testing',
            'email' => 'testing@1utar.my',
            'password' => bcrypt("12345678"),
            'bio' => 'long paragraph long paragraph long paragraph long paragraph long paragraph',
            'allow_location_sharing' => true,
            'role' => 0
        ]);

        User::create([
            'name' => 'sam',
            'email' => 'sam@1utar.my',
            'password' => bcrypt("12345678"),
            'bio' => 'some long paragaph for bio',
            'allow_location_sharing' => false,
            'role' => 0
        ]);

        User::create([
            'name' => 'lee',
            'email' => 'lee@utar.edu.my',
            'password' => bcrypt("12345678"),
            'bio' => 'this is lee lee lee lee lee lee lee lee',
            'allow_location_sharing' => true,
            'role' => 1
        ]);

        User::create([
            'name' => 'hui',
            'email' => 'hui@utar.edu.my',
            'password' => bcrypt("12345678"),
            'bio' => '',
            'allow_location_sharing' => false,
            'role' => 1
        ]);

        User::create([
            'name' => 'xuan',
            'email' => 'xuan@utar.edu.my',
            'password' => bcrypt("12345678"),
            'bio' => 'lecturer at utar',
            'allow_location_sharing' => false,
            'role' => 1
        ]);

        User::create([
            'name' => 'jo',
            'email' => 'jo@utar.edu.my',
            'password' => bcrypt("12345678"),
            'bio' => 'SE',
            'allow_location_sharing' => true,
            'role' => 1
        ]);

        User::create([
            'name' => 'lhxj',
            'email' => 'lhxj@utar.edu.my',
            'password' => bcrypt("12345678"),
            'bio' => 'lhxj lecturer',
            'allow_location_sharing' => true,
            'role' => 1
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@utar.edu.my',
            'password' => bcrypt("12345678"),
            'bio' => 'admin',
            'allow_location_sharing' => false,
            'role' => 2
        ]);
    }
}
