<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    //
    protected $table = 'sekolah';
    public function gambar(){
//        return $this->hasMany('App\Gambar','sekolah_npsn');
        return $this->hasOne('App\Gambar');
    }
    public function kecamatan(){
        return $this->belongsTo('App\Kecamatan');

//        return $this->belongsTo('App\Kecamatan','nama_kecamatan');
//        return $this->hasMany('App\Gambar');
    }
}
