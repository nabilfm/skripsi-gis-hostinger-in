<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSekolahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sekolah', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('npsn')->unique();
            $table->string('alamat');
            $table->string('akreditasi',1);
            $table->double('latitude',12,9);
            $table->double('longitude',12,9);
            $table->string('kdpos',6);
            $table->integer('kecamatan_id')->unsigned()->index();
            $table->string('kelurahan');
            $table->string('propinsi');
            $table->string('status');
            $table->string('waktu');
            $table->string('jenjang',3);
            $table->string('telepon',15)->nullable();
            $table->string('fax',15)->nullable();
            $table->string('email',50)->nullable();
            $table->string('website')->nullable();
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
        Schema::drop('sekolah');
    }
}
