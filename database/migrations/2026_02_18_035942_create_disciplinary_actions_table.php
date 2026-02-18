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
        Schema::create('disciplinary_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained();
            $table->enum('level', ['Teguran', 'SP1', 'SP2', 'SP3']);
            $table->text('reason');
            $table->date('issued_date');
            $table->date('expired_date');
            $table->string('document_path')->nullable(); // Scan surat
            $table->foreignId('issued_by')->constrained('users'); // Atasan/HR yang tanda tangan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disciplinary_actions');
    }
};
