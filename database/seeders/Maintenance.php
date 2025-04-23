<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Maintenance as MaintenanceModel;
use App\Models\MaintenanceExpense;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Maintenance extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('maintenance_types')->insert([
            ['type' => 'Electrical', 'description' => 'ELectrical repairs that include wiring, circuit breakers, and outlets'],
            ['type' => 'HVAC', 'description' => 'Heating, ventilation, and air conditioning'],
            ['type' => 'Plumbing', 'description' => 'Plumbing repairs that include pipes, faucets, and toilets'],
            ['type' => 'Landscaping', 'description' => 'Landscaping repairs that include lawn care and gardening'],
            ['type' => 'Repairs', 'description' => 'General repairs that include fixing broken items'],
        ]);

         DB::table('maintenance_statuses')->insert([
            ['name' => 'Pending', 'description' => 'The maintenance request has been submitted but not yet reviewed.'],
            ['name' => 'In Progress', 'description' => 'The maintenance work is currently being performed.'],
            ['name' => 'Completed', 'description' => 'The maintenance work has been successfully completed.'],
            ['name' => 'On Hold', 'description' => 'The maintenance work is temporarily paused.'],
            ['name' => 'Cancelled', 'description' => 'The maintenance request has been cancelled.'],
            ['name' => 'Scheduled', 'description' => 'The maintenance work has been scheduled for a specific date.'],
            ['name' => 'Awaiting Approval', 'description' => 'The maintenance request is waiting for approval from an admin or owner.'],
            ['name' => 'Awaiting Parts', 'description' => 'The maintenance is delayed due to waiting for parts or materials.'],
            ['name' => 'Inspection Required', 'description' => 'The maintenance requires an inspection before proceeding.'],
            ['name' => 'Escalated', 'description' => 'The maintenance issue has been escalated to a higher authority or priority.'],
            ['name' => 'Resolved', 'description' => 'The maintenance issue has been resolved but not yet verified.'],
            ['name' => 'Verified', 'description' => 'The maintenance work has been verified as complete and satisfactory.'],
            ['name' => 'Failed', 'description' => 'The maintenance attempt was unsuccessful and requires further action.'],
            ['name' => 'Reopened', 'description' => 'The maintenance issue has been reopened after being marked as resolved.'],
            ['name' => 'Deferred', 'description' => 'The maintenance work has been postponed to a later date.'],
        ]); 
        // Generate 20 maintenance records using the factory
        MaintenanceModel::factory()->count(20)->create();

        // Generate 40 expenses (2 per maintenance on average)
        MaintenanceExpense::factory()->count(100)->create();
    }
}
