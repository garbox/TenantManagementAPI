<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\PropertyOwner;
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
            'state_id' => $this->faker->numberBetween(1, 50), // Assuming state IDs range from 1 to 50
            'zip' => $this->faker->postcode,
            'property_owner_id' => PropertyOwner::pluck('id')->random(), // Random owner ID from the database
        ];
    }
}