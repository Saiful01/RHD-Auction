<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotItemsTable extends Migration
{
    public function up()
    {
        Schema::create('lot_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('tree_no')->nullable();
            $table->string('dia')->nullable();
            $table->float('quantity', 15, 9)->nullable();
            $table->string('unit');
            $table->decimal('unit_price', 15, 2)->nullable();
            $table->float('estimated_price', 15, 9)->nullable();
            $table->string('item_image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
