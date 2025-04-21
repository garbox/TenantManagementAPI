<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(Role::class);
        $this->call(States::class);
        $this->call(User::class);
        $this->call(PropertyOwner::class);
        $this->call(PropertySeeder::class);
        $this->call(Maintenance::class);
        $this->call(Agreement::class);
    }
}
