<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorySpecialPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_special_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_order_id')->constrained('data_barangs')->onDelete('cascade');
            $table->bigInteger('special_price');
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
        Schema::dropIfExists('history_special_prices');
    }
}
