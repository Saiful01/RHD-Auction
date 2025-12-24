<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignationsTable extends Migration
{
    public function up()
    {
        Schema::create('designations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('designation')->nullable();
            $table->string('designation_en')->unique();
            $table->string('designation_bn')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
