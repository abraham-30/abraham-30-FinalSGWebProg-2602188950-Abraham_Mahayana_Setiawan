<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create('id_ID');
        $gender = $faker->randomElement(['Male', 'Female']);
        $firstName = $gender === 'Male' ? $faker->firstNameMale() : $faker->firstNameFemale();
        return [
            'name' => $firstName,
            "username" => $firstName,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            "password"=>bcrypt("123"),
            "instagramUsername"=> "http://www.instagram.com/".$firstName,
            "gender" => $gender,
            "age" => $faker->numberBetween(1,65),
            "mobileNumber" => "08".$faker->randomNumber(8, true),
            "regPrice" => $faker->numberBetween(100000, 125000),
            "userCoin" => $faker->numberBetween(50, 125000),
            "hasPaid" => 'true',
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
