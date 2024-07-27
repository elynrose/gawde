<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserHabitsTable extends Migration
{
    public function up()
    {
        Schema::create('user_habits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('notify_by_email')->default(0)->nullable();
            $table->boolean('send_sms_reminder')->default(0)->nullable();
            $table->boolean('agreed_to_terms')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
