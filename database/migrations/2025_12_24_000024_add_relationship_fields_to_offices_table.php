<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOfficesTable extends Migration
{
    public function up()
    {
        Schema::table('offices', function (Blueprint $table) {
            $table->unsignedBigInteger('office_type_id')->nullable();
            $table->foreign('office_type_id', 'office_type_fk_10781876')->references('id')->on('office_types');
        });
    }
}
