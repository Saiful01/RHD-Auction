<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRoadsTable extends Migration
{
    public function up()
    {
        Schema::table('roads', function (Blueprint $table) {
            $table->unsignedBigInteger('division_id')->nullable();
            $table->foreign('division_id', 'division_fk_10781823')->references('id')->on('divisions');
        });
    }
}
