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
        Schema::create('fps_request_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fps_request_id')->constrained()->onDelete('cascade');
            
            // Request Quantity
            $table->integer('request_quantity')->default(1); // Jumlah Permintaan
            
            // Position needed
            $table->foreignId('position_id')->constrained('positions');
            
            // Qualifications (from form)
            $table->string('education_level')->nullable(); // Tingkat Pendidikan
            $table->string('major')->nullable(); // Jurusan
            $table->enum('gender', ['L', 'P', 'Semua'])->nullable()->default('Semua'); // Jenis Kelamin
            $table->string('marital_status')->nullable(); // Status Perkawinan
            $table->string('age_range')->nullable(); // Usia (e.g., "25-35 tahun")
            
            // Requirements & Competencies
            $table->text('work_requirements')->nullable(); // Persyaratan/Pengalaman Kerja
            $table->text('special_skills')->nullable(); // Keahlian Khusus
            $table->text('job_description')->nullable(); // Uraian Tugas
            
            // Report To
            $table->string('report_to')->nullable(); // Pertanggungjawaban Tugas Kepada
            
            // Employment Status
            $table->enum('employment_status', [
                'intern', // Intern
                'contract',   // Contract
                'permanent'      // Permanent
            ])->default('contract');
            
            // Equipment Needs
            $table->boolean('need_work_desk')->default(false); // Meja Kerja
            $table->boolean('need_uniform')->default(false); // Seragam
            $table->boolean('need_computer_laptop')->default(false); // Komputer/Laptop
            $table->boolean('need_email')->default(false); // Email
            $table->string('other_needs')->nullable(); // Lainnya
            
            // Fulfillment tracking
            $table->integer('fulfilled_quantity')->default(0); // Jumlah Terpenuhi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fps_request_items');
    }
};
