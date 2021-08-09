<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryDiskonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_diskons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_order_id')->constrained('barang_orders')->onDelete('cascade');
            $table->integer('diskon');
            $table->bigInteger('harga_diskon');
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
        Schema::dropIfExists('history_diskons');
    }
}
