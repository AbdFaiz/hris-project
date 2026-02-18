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
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            // Relasi hirarki
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('division_id')->constrained()->onDelete('cascade');
            $table->foreignId('unit_id')->constrained()->onDelete('cascade');

            // Self-referencing relationship untuk Parent Position (Atasan)
            $table->foreignId('parent_id')->nullable()->constrained('positions')->onDelete('set null');

            $table->string('position_id')->unique(); // ID Jabatan
            $table->string('name'); // Nama Jabatan
            

            $table->longText('profile')->nullable(); // Uraian Tugas / Job Desc
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
        Schema::dropIfExists('positions');
    }
};
