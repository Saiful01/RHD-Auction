<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLotsTable extends Migration
{
    public function up()
    {
        Schema::table('lots', function (Blueprint $table) {
            $table->unsignedBigInteger('road_id')->nullable();
            $table->foreign('road_id', 'road_fk_10781846')->references('id')->on('roads');
            $table->unsignedBigInteger('package_id')->nullable();
            $table->foreign('package_id', 'package_fk_10781847')->references('id')->on('packages');
        });
    }
}
