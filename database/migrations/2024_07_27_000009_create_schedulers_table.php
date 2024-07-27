<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulersTable extends Migration
{
    public function up()
    {
        Schema::create('schedulers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('today');
            $table->boolean('reminded')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
