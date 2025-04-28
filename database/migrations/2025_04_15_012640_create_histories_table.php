<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('salesman_id');
            $table->unsignedBigInteger('branch_id');
            $table->date('periode'); // Bisa digunakan untuk tanggal atau bulan tertentu
            $table->integer('total_followups')->default(0);
            $table->integer('total_spk')->default(0);
            $table->integer('total_pending')->default(0);
            $table->integer('total_rejected')->default(0);
            $table->softDeletes();
            $table->timestamps();

            // Foreign keys
            $table->foreign('salesman_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
