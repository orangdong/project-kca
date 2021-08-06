<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataGudangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_gudangs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('barcode');
            $table->string('name');
            $table->string('satuan');
            $table->bigInteger('harga_satuan');
            $table->integer('stok');
            $table->integer('buffer');
            $table->string('expired_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_gudangs');
    }
}
