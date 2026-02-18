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
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            // Relasi ke Company (Pusat)
            $table->foreignId('company_id')->constrained()->onDelete('cascade');

            $table->string('region_id')->unique(); // Contoh: REG01
            $table->string('name'); // Contoh: Wilayah Jawa Barat
            

            // Relasi ke Employee untuk Kepala Wilayah
            $table->foreignId('head_id')->nullable()->constrained('employees')->onDelete('set null');

            $table->boolean('is_active')->default(true); // Status Active/Inactive

            // Region Information
            $table->text('address');
            $table->string('city');
            $table->string('province');
            $table->string('postcode');
            $table->string('phone_number');

            // Log Activity (diatur otomatis oleh Filament & Laravel)
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
