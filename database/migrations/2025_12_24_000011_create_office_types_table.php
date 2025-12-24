<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeTypesTable extends Migration
{
    public function up()
    {
        Schema::create('office_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('name_bn')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
