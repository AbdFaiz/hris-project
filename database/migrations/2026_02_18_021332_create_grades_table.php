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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->string('grade_id')->unique(); // ID Pangkat (Angka/Huruf)
            $table->string('name'); // Contoh: Grade 1, Grade 2, atau Staff, Manager
            

            $table->longText('profile')->nullable(); // Deskripsi kualifikasi grade
            $table->boolean('is_active')->default(true);

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
        Schema::dropIfExists('grades');
    }
};
