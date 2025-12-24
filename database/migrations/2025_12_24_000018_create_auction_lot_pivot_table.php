<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionLotPivotTable extends Migration
{
    public function up()
    {
        Schema::create('auction_lot', function (Blueprint $table) {
            $table->unsignedBigInteger('auction_id');
            $table->foreign('auction_id', 'auction_id_fk_10781919')->references('id')->on('auctions')->onDelete('cascade');
            $table->unsignedBigInteger('lot_id');
            $table->foreign('lot_id', 'lot_id_fk_10781919')->references('id')->on('lots')->onDelete('cascade');
        });
    }
}
