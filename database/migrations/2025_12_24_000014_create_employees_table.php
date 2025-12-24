<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cadre_name')->nullable();
            $table->string('charge_type')->nullable();
            $table->string('post_type')->nullable();
            $table->string('job_status')->nullable();
            $table->string('name_en');
            $table->string('name_bn')->nullable();
            $table->string('personnel')->unique();
            $table->integer('gradation')->nullable();
            $table->string('grade')->nullable();
            $table->string('bcs_no')->nullable();
            $table->string('passing_year')->nullable();
            $table->date('birth_date')->nullable();
            $table->date('date_of_retirement')->nullable();
            $table->string('phone_office')->nullable();
            $table->string('phone_personal')->nullable();
            $table->string('email_office')->nullable();
            $table->string('email_personal')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
