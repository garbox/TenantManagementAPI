<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agreement_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Store the status name, like 'draft', 'approved', etc.
            $table->string('description'); // A short description of the status
            $table->timestamps(); // Timestamp for when the status was created/updated
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agreement_statuses');
    }
};
