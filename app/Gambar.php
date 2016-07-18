<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gambar extends Model
{
    //
    protected $table = 'gambar';
    public function sekolah(){
//        return $this->belongsTo('App\Sekolah','npsn_sekolah');
        return $this->belongsTo('App\Sekolah');
    }
}
