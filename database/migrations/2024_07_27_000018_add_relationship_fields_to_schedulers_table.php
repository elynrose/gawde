<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSchedulersTable extends Migration
{
    public function up()
    {
        Schema::table('schedulers', function (Blueprint $table) {
            $table->unsignedBigInteger('habit_id')->nullable();
            $table->foreign('habit_id', 'habit_fk_9977186')->references('id')->on('habits');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9977179')->references('id')->on('users');
        });
    }
}
