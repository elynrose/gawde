<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUserHabitsTable extends Migration
{
    public function up()
    {
        Schema::table('user_habits', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_9977255')->references('id')->on('users');
            $table->unsignedBigInteger('habit_id')->nullable();
            $table->foreign('habit_id', 'habit_fk_9977256')->references('id')->on('habits');
        });
    }
}
