<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    //
    protected $table = 'kecamatan';
    public function sekolah(){
//        return $this->hasMany('App\Gambar','sekolah_npsn');
        return $this->hasMany('App\Sekolah');
    }
}
