<?php

namespace App\Http\Controllers;

use App\Kecamatan;
use App\Sekolah;
use App\SMP;
use Illuminate\Support\Facades\Lang;
use JavaScript;
use Illuminate\Http\Request;

use App\Http\Requests;

class Pengontrol extends Controller
{

    public function home(){
        $smp = Sekolah::where('jenjang','smp')->Paginate(10);
        $sma = Sekolah::where('jenjang','sma')->Paginate(10);
        $lang = 'id';
        Lang::setLocale($lang);

        return view('home',compact(['smp','sma','lang']));
    }
    public function homeGIS(){
        $artotsma   = [];
        $artotsmp   = [];
        $kecamatan = false;
        $selkec     = Kecamatan::all();
        $tipe       = 'SMP dan SMA';
        $sekolah    = null;
        $jenjang    = $tipe;
        $keterangan = 'setiap Kecamatan di ';
        foreach ($selkec as $kc) {
            $sma = Sekolah::where('kecamatan_id',$kc->id)->where('jenjang','sma')->get();
            $smp = Sekolah::where('kecamatan_id',$kc->id)->where('jenjang','smp')->get();
            array_push($artotsma,count($sma));
            array_push($artotsmp,count($smp));
        }
        $lang = 'id';
        Lang::setLocale($lang);
        JavaScript::put([
            'kecamatan' => $selkec,
            'home'      => true,
            'jmlsmp'    => $artotsmp,
            'jmlsma'    => $artotsma
        ]);

        return view('beranda',compact(['selkec','lang','tipe','jenjang','keterangan','sekolah','kecamatan']));
    }

    public function indexLogin(){
        return view('login');
    }
    public function about(){
        return view('page');
    }

    public function hash($text){
        return bcrypt($text);
    }
    public function konten($kd){
        $lang = 'id';
        if($kd==='1') {
            $smp = Sekolah::where('jenjang', 'smp')->Paginate(10);
            return view('home.content-smp',compact(['smp','lang']));
        }elseif($kd==='2'){
            $sma = Sekolah::where('jenjang','sma')->Paginate(10);
            return view('home.content-sma',compact(['sma','lang']));
        }
    }
}
