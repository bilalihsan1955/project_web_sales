<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('follow_ups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('salesman_id')->nullable();  // Make it nullable
            $table->date('followup_date');
            $table->enum('status', ['pending', 'spk', 'rejected']);
            $table->string('channel')->nullable();
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        
            // Foreign keys
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('salesman_id')->references('id')->on('user')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('follow_ups', function (Blueprint $table) {
            $table->dropForeign(['salesman_id']);  // Hapus foreign key terlebih dahulu
            $table->dropForeign(['customer_id']);  // Hapus foreign key untuk customer_id
        });

        Schema::dropIfExists('follow_ups');
    }
};
