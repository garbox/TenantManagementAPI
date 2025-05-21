<?php

use App\Models\Agreement;
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
        Schema::create('pet_addendums', function (Blueprint $table) {
            $table->id();
            $table->boolean('pets_allowed')->default(true);
            $table->string('requirement')->nullable();
            $table->integer('pet_deposit')->nullable();
            $table->integer('pet_monthly_rate')->nullable();
            $table->foreignIdFor(Agreement::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_addendums');
    }
};
