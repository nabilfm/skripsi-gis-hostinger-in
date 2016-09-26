<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class kontrolAdmin extends Controller
{
    //
    public function keluarinUser()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
        {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
        {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        //die($ip);
        return $ip;
    }

    public function masukinUser(Request $minta){
        $nama 		= $minta['username'];
//		dd($minta->all());
        if(Auth::attempt(['uname' => $nama,'password'=>$minta['p']])){
            $ippaddr		= $this->getRealIpAddr();

            $user 			= User::where('uname',$nama)->first();
            $tipe_user 		= $user->level;
            $user->ip_addr 	= $ippaddr;
            $user->save();
            return redirect()->route('home');
        }
        return redirect()->back();
    }
}
