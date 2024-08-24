<?php

namespace Database\Seeders;

use App\Models\FriendList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FriendListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        FriendList::factory()->create([
            "user_id" => '1',
            "friend_id" => '2',
        ]);
        FriendList::factory()->create([
            "user_id" => '1',
            "friend_id" => '3',
        ]);
        FriendList::factory()->create([
            "user_id" => '1',
            "friend_id" => '4',
        ]);
        FriendList::factory()->create([
            "user_id" => '1',
            "friend_id" => '5',
        ]);
        FriendList::factory()->create([
            "user_id" => '1',
            "friend_id" => '6',
        ]);
    }
}
