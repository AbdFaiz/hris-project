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
        Schema::create('fps_requests', function (Blueprint $table) {
            $table->id();
            // FPS Number (Auto-generated) - format: 001/ACS-HCM/FPS/I/2025
            $table->string('fps_number')->unique();
            
            // Requester Info (Auto from login)
            $table->foreignId('applicant_id')->constrained('employees');
            $table->string('applicant_name'); // Nama Pemohon
            $table->string('applicant_position'); // Jabatan Pemohon
            $table->string('applicant_region'); // Wilayah Pemohon
            
            // Form Fields (from Excel/PDF)
            $table->date('request_date')->default(now()); // Tanggal Permintaan
            $table->date('needed_date'); // Tanggal Dibutuhkan
            
            // Request Reason
            $table->enum('request_type', ['addition', 'replacement'])->default('addition'); // Penambahan/Penggantian
            $table->text('request_reason'); // Penjelasan Alasan
            $table->text('result_reason')->nullable(); // Penjelasan Alasan di setujiui / ditolak
            $table->enum('status', ['pending','approved', 'rejected'])->default('pending');
        
            // Final Status
            $table->enum('final_status', ['draft', 'active', 'closed', 'cancelled'])->default('draft');
            $table->timestamp('closed_at')->nullable();
            
            // Logs
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fps_requests');
    }
};
