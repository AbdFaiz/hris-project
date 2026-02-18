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
        Schema::create('employee_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('identity_number'); // No KTP
            $table->text('address_ktp');
            $table->text('address_domicile');
            $table->string('religion');
            $table->string('last_education');
            $table->string('blood_type', 5)->nullable();
            $table->string('photo_path')->nullable(); // Untuk 2f (ID Card)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_details');
    }
};
