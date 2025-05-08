<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User as ModelUser;


class User extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'role_id' => 1,
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => Carbon::today(),
            'password' => Hash::make('123456789'),
        ]);

        DB::table('users')->insert([
            'role_id' => 2,
            'name' => 'Maintience',
            'email' => 'maintience@maintience.com',
            'email_verified_at' => Carbon::today(),
            'password' => Hash::make('123456789'),
        ]);

        DB::table('users')->insert([
            'role_id' => 3,
            'name' => 'Tenate',
            'email' => 'tenate@tenate.com',
            'email_verified_at' => Carbon::today(),
            'password' => Hash::make('123456789'),
        ]);

        $userId = DB::table('users')->insertGetId([
            'role_id' => 4,
            'name' => 'Owner',
            'email' => 'owner@owner.com',
            'email_verified_at' => Carbon::today(),
            'password' => Hash::make('123456789'),
        ]);

        $user = ModelUser::find($userId);

        $user->propertyOwner()->create([
            'address' => '123 Main St',
            'phone' => '512-555-1234',
            'city' => 'Some City',
            'state_id' => 43,
            'zip' => '78701',
            'dba' => 'Doe Rentals',
        ]);

    }
}
