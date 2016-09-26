<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Model implements Authenticatable
{
    //
    //
    //
    protected $table = 'admin';
    protected $hidden = 'password';
    use \Illuminate\Auth\Authenticatable;

    public function isAnAdministrator()
    {
        return \Auth::user()->uname === 'nabizan' ? true : false;
    }
}
