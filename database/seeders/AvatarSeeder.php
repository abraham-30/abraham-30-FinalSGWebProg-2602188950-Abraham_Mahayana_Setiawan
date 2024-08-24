<?php

namespace Database\Seeders;

use App\Models\Avatar;
use Database\Factories\AvatarFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvatarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Avatar::factory()->create([
            "avatarImg"=>"/assets/images/avatars/ape-crown.png",
            "avatarName"=>"Bored Ape Crown",
            "avatarPrice"=>100000,
        ]);
        Avatar::factory()->create([
            "avatarImg"=>"/assets/images/avatars/ape-brave.jpg",
            "avatarName"=>"Bored Ape Brave",
            "avatarPrice"=>50,
        ]);
        Avatar::factory()->create([
            "avatarImg"=>"/assets/images/avatars/ape-a.jpg",
            "avatarName"=>"Bored Ape A+",
        ]);
        Avatar::factory()->create([
            "avatarImg"=>"/assets/images/avatars/ape-skele.jpg",
            "avatarName"=>"Bored Ape Skeleton",
        ]);
        Avatar::factory()->create([
            "avatarImg"=>"/assets/images/avatars/cool-ape.png",
            "avatarName"=>"Cool Bored Ape",
        ]);
        Avatar::factory()->create([
            "avatarImg"=>"/assets/images/avatars/cool-bear.png",
            "avatarName"=>"Cool Bear",
        ]);
        Avatar::factory()->create([
            "avatarImg"=>"/assets/images/avatars/crown-bear.png",
            "avatarName"=>"Cool Bear - Crown",
        ]);
        Avatar::factory()->create([
            "avatarImg"=>"/assets/images/avatars/gold-bear.png",
            "avatarName"=>"Cool Bear - Gold",
        ]);
        Avatar::factory()->create([
            "avatarImg"=>"/assets/images/avatars/prison-bear.png",
            "avatarName"=>"Cool Bear - Prison",
        ]);
    }
}
