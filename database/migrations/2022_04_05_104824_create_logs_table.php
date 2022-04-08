<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('returns')) {
        Schema::create('logs', function (Blueprint $table) {
            $table->increments('id');
                $table->integer('s_id')->unsigned();
                $table->foreign('s_id')->references('id')->on('students');
                $table->integer('b_id')->unsigned();
                $table->foreign('b_id')->references('id')->on('books');
                $table->string('title',50);
                $table->datetime('issue_date');
                $table->datetime('return_date');
                $table->timestamps();
        });
    }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
