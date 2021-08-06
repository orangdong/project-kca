<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyGetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_gets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_barang_id')->constrained('data_barangs')->onDelete('cascade');
            $table->integer('buy');
            $table->integer('get');
            $table->integer('item_get_id');
            $table->string('valid_until');
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
        Schema::dropIfExists('buy_gets');
    }
}
