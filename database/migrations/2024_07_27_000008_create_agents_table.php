<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('review_results')->nullable();
            $table->date('date_reviewed')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
