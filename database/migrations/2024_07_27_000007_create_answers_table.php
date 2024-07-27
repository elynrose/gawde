<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('answer')->nullable();
            $table->integer('score')->nullable();
            $table->date('submitted_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
