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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('division_id')->constrained()->onDelete('cascade');

            $table->string('unit_id')->unique(); // ID Unit Kerja (Angka/Huruf)
            $table->string('name'); // Nama Unit Kerja
            

            $table->longText('profile')->nullable(); // Profile Unit Kerja
            $table->boolean('is_active')->default(true); // Status Active/Inactive

            // Log Activity
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_kerjas');
    }
};
