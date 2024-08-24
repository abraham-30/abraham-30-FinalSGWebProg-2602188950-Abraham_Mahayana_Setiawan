<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::factory()->create([
            "username" => "Abraham",
            "name" => "Abraham",
            "gender" => "Male",
            "age" => "20",
            "instagramUsername" => "http://www.instagram.com/abraham-m30",
            "profilePic" => "/assets/images/default-avatar-icon.png"
        ]);

        User::factory(24)->create([
            "profilePic" => "/assets/images/default-avatar-icon.png"
        ]);
    }
}
