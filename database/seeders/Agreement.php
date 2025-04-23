<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Property;


class Agreement extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('agreements')->insert([
            'user_id' => User::first()->id,
            'property_id' => Property::first()->id,
            'file_name' => 'some_file_name',
            'security_deposit' => 500,
            'rent' => 1700,
            'start_date' => '2023-01-01',
            'end_date' => '2024-01-01',
            'agreement_status_id' => 1
        ]);
    }
}
