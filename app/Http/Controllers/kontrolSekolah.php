<?php

namespace App\Http\Controllers;

use App\Gambar;
use App\Kecamatan;
use App\Sekolah;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use JavaScript;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Route;

class kontrolSekolah extends Controller
{
    //
    public function indexCreate(){
        $selkec = Kecamatan::all();
//        $selkec = Kelurahan::lists('nama');
        $label  = 'Sekolah Baru';
//        return view('sekolah.new',compact(['label','selkec','selkel']));
        return view('sekolah.new',compact(['label','selkec']));
    }
    public function indexEdit($npsn){
        $label      = 'Perbarui Sekolah';
        $selkec     = Kecamatan::all();
        $sekolah    = Sekolah::where('npsn',$npsn)->first();
        return view('sekolah.new',compact(['label','sekolah','selkec']));
    }

    public function tabel()
    {
        $smp = Sekolah::where('jenjang','smp')->Paginate(10);
        $sma = Sekolah::where('jenjang','sma')->Paginate(10);
        $lang = 'id';
        Lang::setLocale($lang);

        return view('home.guest',compact(['smp','sma','lang']));
    }

    public function peta($jenjang){
        $gambar = [];
        $kecamatan  =false;
        $selkec = Kecamatan::orderBy('id','ASC')->get();
        if ($jenjang==='smp' || $jenjang==='sma') {
            $tipe       = strtoupper($jenjang);
            $sekolah    = Sekolah::where('jenjang',$jenjang)->get();
        }elseif($jenjang==='semua'){
            $tipe       = 'SMP dan SMA';
            $sekolah = Sekolah::all();
        }else{
            dd('error');
        }
//        dd($selkec);
        foreach ($sekolah as $sk) {
            if (count($sk->gambar)) {
                $url = $sk->gambar->path.$sk->gambar->filename;
                array_push($gambar,$url);
            }
        }
        $keterangan = 'setiap Kecamatan di ';
        $lang = 'id';
        Lang::setLocale($lang);
        JavaScript::put([
            'selkec'    => $selkec,
            'sekolah'   => $sekolah,
            'gambar'    => $gambar,
            'home'      => false,
            'semua'     => true,
        ]);
        return view('beranda',compact(['jenjang','lang','tipe','keterangan','selkec','kecamatan']));
    }

    public function maps($jenjang, $kecamatan){
        $gambar = [];
        $selkec = Kecamatan::orderBy('id','ASC')->get();
        $kec    = Kecamatan::findOrFail($kecamatan);
        $sekolah    = $jenjang==="semua" ? $kec->sekolah()->get() : $kec->sekolah->where('jenjang',$jenjang);
        $tipe   = 'SMA';
        if ($jenjang==='semua') {
            $tipe       = 'SMP dan SMA';
        }else {
            $tipe = $jenjang==='smp' ? 'SMP':'SMA';
        }
//        dd($kec);
//        dd($selkec);

        foreach ($sekolah as $sk) {
            if (count($sk->gambar)) {
                $url = $sk->gambar->path.$sk->gambar->filename;
                array_push($gambar,$url);
            }
        }
        $keterangan = 'Kecamatan '.$kec->nama.', ';
        $all    = false;
        JavaScript::put([
            'selkec'    => $selkec,
            'gambar'    => $gambar,
            'sekolah'   => $sekolah,
            'home'      => $all
        ]);
        return view('beranda',compact(['tipe','lang','keterangan','jenjang','kec','kecamatan','selkec']));
    }
    public function mapsSingle($npsn){
        $sekolah    = Sekolah::where('npsn',$npsn)->first();
        $tipe       = 'SMA';
        $all        = false;
        $namarute   = Route::currentRouteName();
        $gambar     = $sekolah->gambar ? $sekolah->gambar->path.$sekolah->gambar->filename: 'undefined.png';
//        dd($gambar);
        $arahkan    = $namarute === "map.sekolah.arahkan" ? true : false ;
        JavaScript::put([
            'lokasi'    => $sekolah,
            'gambar'    => $gambar,
            'all'       => $all,
            'arahkan'   => $arahkan
        ]);
        return view('maps',compact(['all','sekolah','tipe','lang','arahkan']));
    }

    public function cekavail(Request $minta){
        if($minta->ajax()){
            $tempName	= $minta['tmpnm'];
            $fn 		= $minta['SC_label'];
            if($tempName === $fn){
                $hasil 	= 'true';
            }else{
                $sekolah =   Sekolah::where('npsn', $fn)->first();
                if ($sekolah){
                    $hasil = 'false';
                }else{
                    $hasil = 'true';
                }
            }
            return $hasil;
        }
        return "where are you from?";
    }
    public function Delete(Request $minta){
        $npsn       = $minta['lblsc'];
        $sekolah    = Sekolah::where('npsn',$npsn)->first();
        $sekolah->delete() ? redirect()->route('home') : dd('gagal menghapus sekolah');

        if($sekolah->delete()){
            Session::flash('success','Berhasil menghapus Sekolah');
            redirect()->route('home');
        }else{
            dd('Gagal menghapus Sekolah');
        }

    }
    public function Save(Request $minta){
        $gid        = $minta['gid'];
        $file       = $minta['image'];
        $npsn       = $minta['SC_label'];
        $nama       = $minta['SC_name'];
        $address    = $minta['SC_address'];
        $latitude   = (float)substr($minta['lat'],0,12);
        $longitude  = (float)substr($minta['lon'],0,12);
        $kdpos      = $minta['SC_kdpos'];
        $kelurahan  = $minta['SC_kelurahan'];
        $kecamatan  = (int)$minta['SC_kecamatan'];
        $phone      = $minta['SC_phone'];
        $fax        = $minta['SC_fax'];
        $email      = $minta['SC_email'];
        $website    = $minta['SC_website'];
        $jenjang    = strtolower($minta['SC_jenjang']);
        $waktu      = $minta['SC_waktu'];
        $status     = 'negeri';
//        $jenjang    = 'sma';
//        $status     = $minta['SC_status'];
//        dd($minta->all());

        $namarute   = Route::currentRouteName();
        if ($namarute === 'school.update') {
            $sekolah    = Sekolah::where('npsn',$npsn)->first();
//            $gambar     = Gambar::findOrFail($gid);
            $gambar     = new Gambar();
        }else{
            $sekolah    = new Sekolah();
            $gambar     = new Gambar();
        }
//        dd($sekolah)
        $sekolah->npsn      = $npsn;
        $sekolah->nama      = $nama;
        $sekolah->alamat    = $address;
        $sekolah->latitude  = $latitude;
        $sekolah->longitude = $longitude;
        $sekolah->kdpos     = $kdpos;
        $sekolah->kelurahan = $kelurahan;
        $sekolah->kecamatan_id = $kecamatan;
        $sekolah->jenjang   = $jenjang;
        $sekolah->waktu     = $waktu;
        $sekolah->status    = $status;
        $sekolah->telepon     = $phone;
        $sekolah->fax       = $fax;
        $sekolah->email     = $email;
        $sekolah->website   = $website;

        $kc                 = Kecamatan::find((int)$kecamatan);
        $path               = 'smbr/img/'.strtolower($kc->nama).'/'.$jenjang.'/'.$npsn.'/';
        if($sekolah->save()){
            /*
             * kondisi disini (upload gambar)
             */
            if ($file) {
                $filename   = 'foto.'.$file->getClientOriginalExtension();
                if ($namarute==='school.update') {
//                    File::delete($gambar->url);
                }
                if ($file->move($path,$filename)) {
                    $gambar->path       = $path;
                    $gambar->filename   = $filename;
                    $sekolah->gambar()->save($gambar);
                }else{
                    dd('gagal simpan gambar');
                }
            }
            Session::flash('success','Berhasil Menyimpan Sekolah');
            echo "<script>alert('Berhasil Menyimpan Sekolah');
                        window.location = '/admin';
                    </script>";
//            return redirect()->route('admin.home');
        } else {
            Session::flash('success','Gagal Menyimpan Sekolah');
            echo "<script>alert('Gagal Menyimpan Sekolah');
                        window.location = '/admin';
                    </script>";
//            return redirect()->route('admin.home');
        }
    }
}
