<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('orderan_id')->constrained('orderans')->onDelete('cascade');
            $table->integer('data_barang_id');
            $table->integer('parcel');
            $table->string('name');
            $table->bigInteger('harga_satuan');
            $table->bigInteger('jumlah');
            $table->bigInteger('harga_subtotal');
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
        Schema::dropIfExists('barang_orders');
    }
}
