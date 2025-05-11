<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOldSalesmanToCustomersTable extends Migration
{
    /**
     * Jalankan migration untuk menambahkan kolom old_salesman ke dalam tabel customers.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            // Menambahkan kolom old_salesman dengan tipe data string (VARCHAR)
            $table->string('old_salesman')->nullable(); // null jika ingin kolom ini boleh kosong
        });
    }

    /**
     * Rollback migration untuk menghapus kolom old_salesman.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            // Menghapus kolom old_salesman
            $table->dropColumn('old_salesman');
        });
    }
}
