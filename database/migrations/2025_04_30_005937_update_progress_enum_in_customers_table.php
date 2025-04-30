<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProgressEnumInCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            // Mengubah enum 'progress' dengan menambahkan nilai baru
            $table->enum('progress', ['pending', 'tidak ada', 'SPK', 'invalid', 'DO'])
                  ->default('pending')
                  ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            // Kembalikan enum ke nilai sebelumnya jika migration di rollback
            $table->enum('progress', ['pending', 'tidak ada', 'SPK'])
                  ->default('pending')
                  ->change();
        });
    }
}
