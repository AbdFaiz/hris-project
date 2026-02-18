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
        Schema::create('company_philosophies', function (Blueprint $table) {
            $table->id();
            // Relasi ke Company
            $table->foreignId('company_id')->constrained()->onDelete('cascade');

            // Vision Section
            $table->longText('vision');
            $table->string('vision_media')->nullable(); // Untuk upload gambar/video visi

            // Mission Section
            $table->longText('mission');
            $table->string('mission_media')->nullable(); // Untuk upload gambar/video misi

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
        Schema::dropIfExists('company_philosophies');
    }
};
