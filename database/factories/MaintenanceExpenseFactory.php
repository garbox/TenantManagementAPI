<?php

namespace Database\Factories;

use App\Models\Maintenance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaintenanceExpense>
 */
class MaintenanceExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'maintenance_id' => Maintenance::inRandomOrder()->first()->id,
            'user_id' => User::where('role_id', 2)->inRandomOrder()->first()->id,
            'expense' => fake()->numberBetween(1000, 50000),
            'note' => fake()->sentence(), // Or keep your static note if preferred
        ];
    }
}
