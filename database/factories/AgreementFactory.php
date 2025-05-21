<?php

namespace Database\Factories;

use App\Models\AgreementStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Property;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AgreementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tenant_id' => User::where('role_id', '=', 3)->inRandomOrder()->first()?->id,
            'property_id' => Property::inRandomOrder()->first()?->id,
            'file_name' => $this->faker->uuid . '.pdf',
            'security_deposit' => $this->faker->numberBetween(50000, 200000),
            'rent' => $this->faker->numberBetween(100000, 300000),
            'late_fee' => $this->faker->numberBetween(1000, 10000),
            'grace_period' => 3,
            'application_fee' => $this->faker->numberBetween(1000, 10000),
            'start_date' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'agreement_status_id' => AgreementStatus::inRandomOrder()->first()->id,
        ];
    }
}
