<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsTable extends Migration
{
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('memo_no')->unique();
            $table->string('announcement_no');
            $table->longText('name');
            $table->longText('details')->nullable();
            $table->datetime('auction_start_time');
            $table->datetime('auction_end_time');
            $table->datetime('tender_visible_start_date')->nullable();
            $table->datetime('tender_visible_end_date')->nullable();
            $table->datetime('tender_sale_start_date')->nullable();
            $table->datetime('tender_sale_end_date')->nullable();
            $table->string('deadline_for_tree_removal')->nullable();
            $table->longText('bidder_criteria')->nullable();
            $table->longText('required_document')->nullable();
            $table->longText('note')->nullable();
            $table->integer('estimate_value_percentage')->nullable();
            $table->float('base_value_amount', 15, 5);
            $table->decimal('min_bid_amount', 15, 2)->nullable();
            $table->integer('vat')->nullable();
            $table->integer('tax')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
