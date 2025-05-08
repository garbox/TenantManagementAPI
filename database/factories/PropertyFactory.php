<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\PropertyOwner;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'state_id' => $this->faker->numberBetween(1, 50),
            'zip' => $this->faker->postcode,
            'owner_id' => User::where('role_id', 4)->first(), 
        ];
    }
}