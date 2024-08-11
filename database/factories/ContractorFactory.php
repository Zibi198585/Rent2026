<?php

namespace Database\Factories;


use App\Models\Contractor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contractor>
 */
class ContractorFactory extends Factory
{
    protected $model = Contractor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'first_name' => $this->faker->firstName(),
            // 'middle_name' => $this->faker->optional()->firstName(),
            // 'last_name' => $this->faker->lastName(),
            // 'address_line_1' => $this->faker->streetAddress(),
            // 'address_line_2' => $this->faker->optional()->secondaryAddress(),
            // 'post_code' => $this->faker->postcode(),
            // 'city' => $this->faker->city(),
            // 'province' => $this->faker->state(),
            // 'country' => $this->faker->country(),
            // 'phone_number' => $this->faker->phoneNumber(),
            // 'email' => $this->faker->unique()->safeEmail(),
            // 'pesel' => $this->faker->optional()->numerify('880416178234'),

            'first_name' =>  $this->faker->firstName(),
            'middle_name' => $this->faker->optional()->firstName(),
            'last_name' =>   $this->faker->lastName(),
            'address_line_1' =>  $this->faker->streetAddress(),
            'address_line_2' =>  $this->faker->optional()->streetAddress(),
            'post_code' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'province' => $this->faker->state(),
            'country' => $this->faker->country(),
            'phone_number' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'pesel' => $this->faker->optional()->numerify('880416178234'),
        ];
    }
}
