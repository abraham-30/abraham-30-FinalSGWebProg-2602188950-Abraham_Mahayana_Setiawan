<?php

namespace Database\Seeders;

use App\Models\AvatarList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AvatarListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        AvatarList::factory()->create([
            "user_id" => '1',
            "avatar_id" => '1',
        ]);
        AvatarList::factory()->create([
            "user_id" => '1',
            "avatar_id" => '2',
        ]);
        AvatarList::factory()->create([
            "user_id" => '1',
            "avatar_id" => '3',
        ]);
    }
}
