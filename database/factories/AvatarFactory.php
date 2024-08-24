<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Avatar>
 */
class AvatarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create("id_ID");
        return [
            //
            "avatarDesc" => $faker->paragraph(5, false),
            "avatarPrice" => $faker->numberBetween(50,100000),
        ];
    }
}
