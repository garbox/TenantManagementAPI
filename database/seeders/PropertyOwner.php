<?php

namespace Database\Seeders;

use App\Models\PropertyOwner as ModelPropertyOwner; 
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertyOwner extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 50 property owners
        ModelPropertyOwner::factory()->count(1)->create()->each(function ($propertyOwner) {
            // Create a corresponding user for each property owner
            User::create([
                'name' => $propertyOwner->name,
                'email' => $propertyOwner->email,
                'password' => bcrypt('password'), // Default password for seeded users
                'role_id' => 4, // Assuming 4 is the role ID for property owners
            ]);
        });
    }
}
