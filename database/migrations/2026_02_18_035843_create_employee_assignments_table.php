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
        Schema::create('employee_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            // Relasi ke tabel Master
            $table->foreignId('region_id')->nullable()->constrained()->onDelete('set null');
    $table->foreignId('division_id')->constrained();
    $table->foreignId('unit_id')->constrained();
    $table->foreignId('position_id')->constrained();
    $table->foreignId('echelon_id')->nullable()->constrained();
    $table->foreignId('grade_id')->nullable()->constrained(); // Ini untuk "Pangkat"

    // Informasi Penugasan
    $table->enum('type', ['Initial', 'Promotion', 'Rotation', 'Mutation', 'Demotion']);
    $table->date('effective_date');
    $table->string('sk_number')->nullable();
    $table->boolean('is_current')->default(true); // Flag posisi aktif saat ini
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_assignments');
    }
};
