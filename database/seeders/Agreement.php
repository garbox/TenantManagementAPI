<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Agreement as AgreementModel;


class Agreement extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AgreementModel::factory()->count(1)->create();
    }
}
