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
            $table->string('nik', 20)->unique();
            $table->string('employee_code');
            $table->string('full_name');
            $table->string('email_internal')->unique();
            $table->enum('gender', ['L', 'P']);
            $table->string('phone_number');
            $table->date('join_date');
            $table->enum('status_perkawinan', ['TK', 'K0', 'K1', 'K2', 'K3']);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
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
