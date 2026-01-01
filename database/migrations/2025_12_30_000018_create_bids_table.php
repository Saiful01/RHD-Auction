<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidsTable extends Migration
{
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('vat', 15, 7)->nullable();
            $table->float('tax', 15, 7)->nullable();
            $table->float('bid_amount', 15, 7)->nullable();
            $table->float('total_amount', 15, 7)->nullable();
            $table->string('is_condition_accept')->nullable();
            $table->string('is_winner')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
