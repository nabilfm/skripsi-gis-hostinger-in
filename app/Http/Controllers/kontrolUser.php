<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Fieldguide;

use App\Http\Requests;

class kontrolUser extends Controller
{
	/*
	 * cek avalaible user
	 */
	public function cekavail(Request $minta){
		$tempName	= $minta['tmpnm'];
		$uname 		= $minta['uname'];
		if($tempName === $uname){
			$hasil 	= 'true';
		}else{
			$user 	=	User::where('uname', $uname)->first();
			if ($user){
				$hasil = 'false';
			}else{
				$hasil = 'true';
			}
		}
		return $hasil;
	}
	/*
	 * user's method
	 */
	public function indexSignup(){
        return view('signup', [
            'labelheader'       => "Create User",
			'user'				=> ""]);
    }
	public function indexEditUs($id){
		if ($id==='1')
		{
			abort(404);
		}
		$user               = User::findOrFail($id);
		return view('signup', [
			'labelheader'   => "Edit User",
			'user'			=> $user]);
	}
//	public function indexEditUs(Request $minta){
//		$rek                = $minta['lbluname'];
//		$user               = User::where('uname',$rek)->first();
//		return view('signup', [
//			'labelheader'   => "Edit User",
//			'user'			=> $user]);
//	}
	public function daftarkanUser(Request $minta){

		$firstname		= ucwords($minta['u_fname']);
		$lastname		= ucwords($minta['u_lname']);
		$email			= $minta['email'];
		$username		= $minta['uname'];
		$password		= bcrypt($minta['password']);
		$phone			= $minta['u_phone'];
		$organization	= $minta['u_organization'];
		$level			= 1;
		$ippaddr		= $this->getRealIpAddr();

		$user 					= new User();
		$user->fname 			= $firstname;
		$user->lname 			= $lastname;
		$user->email 			= $email;
		$user->uname 			= $username;
		$user->password 		= $password;
		$user->phone 			= $phone;
		$user->organization 	= $organization;
		$user->level 		 	= $level;
		$user->ip_addr 			= $ippaddr;
		$user->save();
		return redirect()->route('home');
	}
	public function perbaruiUser(Request $minta){
		$firstname		= ucwords($minta['u_fname']);
		$uid			= $minta['lblid'];
		$lastname		= ucwords($minta['u_lname']);
		$email			= $minta['email'];
		$username		= $minta['uname'];
		$password		= bcrypt($minta['password']);
		$phone			= $minta['u_phone'];
		$organization	= $minta['u_organization'];
		$level			= 1;
		$ippaddr		= $this->getRealIpAddr();

		$user 					= User::findOrFail($uid);
		$user->fname 			= $firstname;
		$user->lname 			= $lastname;
		$user->email 			= $email;
		$user->uname 			= $username;
		$user->password 		= $password;
		$user->phone 			= $phone;
		$user->organization 	= $organization;
		$user->level 		 	= $level;
		$user->ip_addr 			= $ippaddr;
		$user->save();

		return redirect()->route('home');
	}
	public function hapusUser(Request $minta){
		$user 					= User::where('uname',$minta['lbluname']);
		$user->delete();
		return redirect()->route('home');
	}

	/*
	 * user plus's method
	 */
	public function indexSignupUP(Request $minta){
		$fgid 	= $minta['lblfg'];
		return view('signup', [
			'labelheader'       => "Create User Plus",
			'user'				=> '',
			'fg_id'         	=> $fgid]);
	}
	public function indexEditUP($id){
		if ($id==='1')
		{
			abort(404);
		}
		$user               = User::findOrFail($id);
		return view('signup', [
			'labelheader'   => "Edit User Plus",
			'user'			=> $user]);
	}
	public function daftarkanUP(Request $minta){
		$fgid 			= $minta['lblfg'];
		$firstname		= ucwords($minta['u_fname']);
		$lastname		= ucwords($minta['u_lname']);
		$email			= $minta['email'];
		$username		= $minta['uname'];
		$password		= bcrypt($minta['password']);
		$phone			= $minta['u_phone'];
		$organization	= $minta['u_organization'];
		$level			= 2;
		$ippaddr		= $this->getRealIpAddr();

		$fg 					= Fieldguide::find($fgid);
		$user 					= new User();
		$user->fname 			= $firstname;
		$user->lname 			= $lastname;
		$user->email 			= $email;
		$user->uname 			= $username;
		$user->password 		= $password;
		$user->phone 			= $phone;
		$user->organization 	= $organization;
		$user->level 		 	= $level;
		$user->ip_addr 			= $ippaddr;
		$fg->users()->save($user);

		return redirect()->route('editFg',['id'=>$fgid]);
	}
	public function perbaruiUP(Request $minta){
		$fgid			= $minta['lblfg'];
		$uid			= $minta['lblid'];
		$firstname		= ucwords($minta['u_fname']);
		$lastname		= ucwords($minta['u_lname']);
		$email			= $minta['email'];
		$username		= $minta['uname'];
		$password		= bcrypt($minta['password']);
		$phone			= $minta['u_phone'];
		$organization	= $minta['u_organization'];
		$level			= 2;
//		dd($minta->all());
		$ippaddr		= $this->getRealIpAddr();

		$user 					= User::find($uid);
		$user->fname 			= $firstname;
		$user->lname 			= $lastname;
		$user->email 			= $email;
		$user->uname 			= $username;
		$user->password 		= $password;
		$user->phone 			= $phone;
		$user->organization 	= $organization;
		$user->level 		 	= $level;
		$user->ip_addr 			= $ippaddr;

		$user->save();

		return redirect()->route('editFg',['id'=>$fgid]);
	}
	public function hapusUP(Request $minta){
		$fgid 					= $minta['lblfg'];
		$user 					= User::where('uname',$minta['lbluname']);
		$user->delete();

		return redirect()->route('editFg',['id'=>$fgid]);;
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
}
