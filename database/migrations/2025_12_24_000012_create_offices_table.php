<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficesTable extends Migration
{
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('office_name_en')->nullable();
            $table->string('office_name_bn')->nullable();
            $table->string('office_cat')->nullable();
            $table->integer('parent_office')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
