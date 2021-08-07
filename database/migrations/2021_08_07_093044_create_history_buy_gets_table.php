<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryBuyGetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_buy_gets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_order_id')->constrained('data_barangs')->onDelete('cascade');
            $table->integer('buy');
            $table->integer('get');
            $table->integer('item_get_id');
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
        Schema::dropIfExists('history_buy_gets');
    }
}
