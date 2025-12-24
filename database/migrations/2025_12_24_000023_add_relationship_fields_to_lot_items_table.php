<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLotItemsTable extends Migration
{
    public function up()
    {
        Schema::table('lot_items', function (Blueprint $table) {
            $table->unsignedBigInteger('lot_id')->nullable();
            $table->foreign('lot_id', 'lot_fk_10781858')->references('id')->on('lots');
        });
    }
}
