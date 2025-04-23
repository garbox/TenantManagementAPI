<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AgreementStatus;

class AgreementStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'Draft', 'description' => 'Not finalized or sent'],
            ['name' => 'Pending_approval', 'description' => 'Waiting for approval'],
            ['name' => 'Approved', 'description' => 'Approved by all parties'],
            ['name' => 'Rejected', 'description' => 'Rejected by one or more parties'],
            ['name' => 'Awaiting_signature', 'description' => 'Ready to sign'],
            ['name' => 'Partially_signed', 'description' => 'Some signatures received'],
            ['name' => 'Signed', 'description' => 'Fully signed'],
            ['name' => 'Active', 'description' => 'Currently in effect'],
            ['name' => 'Expired', 'description' => 'Reached end date'],
            ['name' => 'Terminated', 'description' => 'Ended before completion'],
            ['name' => 'Cancelled', 'description' => 'Cancelled before taking effect'],
            ['name' => 'Renewal_pending', 'description' => 'Renewal in progress'],
            ['name' => 'Renewed', 'description' => 'Successfully renewed'],
            ['name' => 'Archived', 'description' => 'Stored for records'],
        ];

        foreach ($statuses as $status) {
            AgreementStatus::create($status);
        }
    }
}
