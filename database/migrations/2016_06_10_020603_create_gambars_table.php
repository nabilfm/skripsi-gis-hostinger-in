<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGambarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gambar', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sekolah_id')->unsigned()->index();
            $table->foreign('sekolah_id')->references('id')->on('sekolah')->onDelete('cascade')->onUpdate('cascade');
            $table->string('path');
            $table->string('filename');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gambar');
    }
}
