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
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            // Relasi ke Company (Pilihan diambil dari master perusahaan)
            $table->foreignId('company_id')->constrained()->onDelete('cascade');

            $table->string('division_id')->unique(); // ID Divisi (Karakter angka/huruf)
            $table->string('name'); // Nama Divisi
            

            $table->longText('profile')->nullable(); // Profile/Deskripsi Divisi
            $table->boolean('is_active')->default(true); // Status: Active/Inactive

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
        Schema::dropIfExists('divisions');
    }
};
