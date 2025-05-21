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
        Schema::create('maintenance_addendums', function (Blueprint $table) {
            $table->id();
            $table->text('tenant_responsibilities');
            $table->text('land_lord_responsibilities');
            $table->foreignIdFor(Agreement::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_addendums');
    }
};
