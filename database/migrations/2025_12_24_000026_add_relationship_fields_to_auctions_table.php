<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAuctionsTable extends Migration
{
    public function up()
    {
        Schema::table('auctions', function (Blueprint $table) {
            $table->unsignedBigInteger('financial_year_id')->nullable();
            $table->foreign('financial_year_id', 'financial_year_fk_10781916')->references('id')->on('financial_years');
            $table->unsignedBigInteger('road_id')->nullable();
            $table->foreign('road_id', 'road_fk_10781917')->references('id')->on('roads');
            $table->unsignedBigInteger('package_id')->nullable();
            $table->foreign('package_id', 'package_fk_10781918')->references('id')->on('packages');
        });
    }
}
