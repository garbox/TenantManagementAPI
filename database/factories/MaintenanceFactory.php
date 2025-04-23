<?php

namespace Database\Factories;

use App\Models\MaintenanceType;
use App\Models\MaintenanceStatus;
use App\Models\User;
use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Maintenance>
 */
class MaintenanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'maintenance_type_id' => MaintenanceType::inRandomOrder()->first()->id,
            'user_id' => User::where('role_id', '!=', 2)->inRandomOrder()->first()->id,
            'property_id' => Property::inRandomOrder()->first()->id,
            'description' => fake()->sentence(),
            'maintenance_status_id' => MaintenanceStatus::inRandomOrder()->first()->id,
            'assigned_to' => User::where('role_id', 2)->inRandomOrder()->first()->id,
        ];
    }
}
