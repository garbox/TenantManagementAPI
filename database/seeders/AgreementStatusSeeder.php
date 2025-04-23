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
            ['name' => 'draft', 'description' => 'Not finalized or sent'],
            ['name' => 'pending_approval', 'description' => 'Waiting for approval'],
            ['name' => 'approved', 'description' => 'Approved by all parties'],
            ['name' => 'rejected', 'description' => 'Rejected by one or more parties'],
            ['name' => 'awaiting_signature', 'description' => 'Ready to sign'],
            ['name' => 'partially_signed', 'description' => 'Some signatures received'],
            ['name' => 'signed', 'description' => 'Fully signed'],
            ['name' => 'active', 'description' => 'Currently in effect'],
            ['name' => 'expired', 'description' => 'Reached end date'],
            ['name' => 'terminated', 'description' => 'Ended before completion'],
            ['name' => 'cancelled', 'description' => 'Cancelled before taking effect'],
            ['name' => 'renewal_pending', 'description' => 'Renewal in progress'],
            ['name' => 'renewed', 'description' => 'Successfully renewed'],
            ['name' => 'archived', 'description' => 'Stored for records'],
        ];

        foreach ($statuses as $status) {
            AgreementStatus::create($status);
        }
    }
}
