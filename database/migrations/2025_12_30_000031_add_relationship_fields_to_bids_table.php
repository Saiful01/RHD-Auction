<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBidsTable extends Migration
{
    public function up()
    {
        Schema::table('bids', function (Blueprint $table) {
            $table->unsignedBigInteger('bidder_id')->nullable();
            $table->foreign('bidder_id', 'bidder_fk_10783675')->references('id')->on('bidders');
            $table->unsignedBigInteger('auction_id')->nullable();
            $table->foreign('auction_id', 'auction_fk_10783676')->references('id')->on('auctions');
        });
    }
}
