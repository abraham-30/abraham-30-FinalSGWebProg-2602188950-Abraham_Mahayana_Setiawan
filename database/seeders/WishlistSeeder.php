<?php

namespace Database\Seeders;

use App\Models\Wishlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Wishlist::factory()->create([
            "user_id" => '1',
            "receiver_id" => '7',
        ]);
        Wishlist::factory()->create([
            "user_id" => '1',
            "receiver_id" => '8',
        ]);
        Wishlist::factory()->create([
            "user_id" => '1',
            "receiver_id" => '9',
        ]);
    }
}
