<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidderAuctionRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('bidder_auction_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('pay_amount', 15, 7)->nullable();
            $table->string('is_condition_accept')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
