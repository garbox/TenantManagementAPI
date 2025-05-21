<?php

use App\Models\AgreementStatus;
use App\Models\LeadPaintDisclosure;
use App\Models\MaintenanceAddendum;
use App\Models\MonthToMonthAddendum;
use App\Models\NonRenewalNoticeAddendum;
use App\Models\PetAddendum;
use App\Models\Property;
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
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('users')->onDelete('cascade');
            $table->foreignIdFor(Property::class)->references('id')->on('properties');
            $table->string('file_name')->nullable();
            $table->integer('security_deposit');
            $table->integer('rent');
            $table->integer('late_fee');
            $table->integer('grace_period');
            $table->integer('application_fee');
            $table->date('start_date');
            $table->date('end_date');
            $table->foreignIdFor(AgreementStatus::class)->default(1)->constrained()->onDelete('cascade');    
            $table->foreignIdFor(LeadPaintDisclosure::class)->nullable();
            $table->foreignIdFor(MonthToMonthAddendum::class)->nullable();
            $table->foreignIdFor(PetAddendum::class)->nullable();
            $table->foreignIdFor(MaintenanceAddendum::class)->nullable();
            $table->foreignIdFor(NonRenewalNoticeAddendum::class)->nullable();
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
