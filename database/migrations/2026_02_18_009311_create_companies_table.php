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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_id')->unique(); // ID unik manual (misal: ACS01)
            $table->string('name');
            
            $table->string('level')->nullable(); // Level perusahaan (Holding, Cabang, Unit, dll)

            // Company Information
            $table->text('address');
            $table->string('city');
            $table->string('province');
            $table->string('post_code');
            $table->string('phone_number');
            $table->string('email')->nullable(); // Tambahan: Email resmi
            $table->string('website')->nullable();

            // Tax & Bank
            $table->string('tin_number')->nullable(); // Taxpayer Identification Number (NPWP)
            $table->string('account_number')->nullable(); // No Rekening
            $table->string('account_name')->nullable(); // Nama di Rekening

            // Profile & Media
            $table->longText('profile'); // Profil singkat/Visi Misi
            $table->string('logo')->nullable(); // Path Logo

            // Log
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
