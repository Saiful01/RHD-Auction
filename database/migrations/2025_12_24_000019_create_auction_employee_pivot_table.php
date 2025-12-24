<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionEmployeePivotTable extends Migration
{
    public function up()
    {
        Schema::create('auction_employee', function (Blueprint $table) {
            $table->unsignedBigInteger('auction_id');
            $table->foreign('auction_id', 'auction_id_fk_10782355')->references('id')->on('auctions')->onDelete('cascade');
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id', 'employee_id_fk_10782355')->references('id')->on('employees')->onDelete('cascade');
        });
    }
}
