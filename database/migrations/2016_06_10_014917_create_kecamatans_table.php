<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKecamatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kecamatan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama')->unique();
            $table->double('latitude',12,9);
            $table->double('longitude',12,9);
            $table->timestamps();
        });
        Schema::table('sekolah',function(Blueprint $table){
            $table->foreign('kecamatan_id')->references('id')->on('kecamatan')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('kecamatan');
    }
}
