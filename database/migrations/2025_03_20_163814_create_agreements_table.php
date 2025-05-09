<?php

use App\Models\AgreementStatus;
use App\Models\Property;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('users')->onDelete('cascade');
            $table->foreignIdFor(Property::class)->references('id')->on('properties');
            $table->string('file_name');
            $table->integer('security_deposit');
            $table->integer('rent');
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignIdFor(AgreementStatus::class)->references('id')->on('agreement_statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agreements');
    }
};
