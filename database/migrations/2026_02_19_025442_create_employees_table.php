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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link ke User (untuk ESS)
            $table->string('employee_id')->unique();
            $table->string('name');
             // Relasi Struktur Organisasi - sesuai dropdown di form
            $table->foreignId('company_id')->constrained('companies')->comment('Company');
            $table->foreignId('region_id')->constrained('regions')->comment('Wilayah');
            $table->foreignId('division_id')->constrained('divisions')->comment('Divisi');
            $table->foreignId('unit_id')->constrained('units')->comment('Unit Kerja');
            $table->foreignId('position_id')->constrained('positions')->comment('Jabatan');
            $table->foreignId('echelon_id')->constrained('echelons')->comment('Pangkat');
            $table->foreignId('grade_id')->constrained('grades')->comment('Pangkat');

            $table->date('join_date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
