<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\MaintenanceType;
use App\Models\User;
use App\Models\Property;
use App\Models\MaintenanceStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MaintenanceType::class)->references('id')->on('maintenance_types');
            $table->foreignIdFor(User::class)->references('id')->on('users');
            $table->foreignIdFor(Property::class)->references('id')->on('properties');
            $table->string('description');
            $table->foreignIdFor(MaintenanceStatus::class)->references('id')->on('maintenance_statuses');
            $table->foreignId('assigned_to')->nullable(); // Foreign key for users table
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null'); // Reference to users table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_requests');
    }
};
