@extends('layouts.login')

@section('title', 'login page')

@section('content')
		<form action="{{ route('masuk') }}" method="post" name="login_form">
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-social-person-outline prefix"></i>
                        <input id="username" required type="text" name="username" />
                        <label for="username" >Username</label>
                    </div>
                </div>
                <div class="row margin">
                    <div class="input-field col s12">
                        <i class="mdi-action-lock-outline prefix"></i>
                        <input type="password" name="password" id="password"/>
                        <label for="password">Password</label>
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <!--<input type="button" 
                               value="Login" 
                               onclick="formhash(this.form, this.form.password);" /> -->
                    </div>
                </div>
                <div class="clearfix">
                    
                </div>
                    <center>

                        <button class="btn valign yellow black-text" onclick="formhash(this.form, this.form.password);">Login
                        {{--<button class="btn valign" >Login--}}
                                <i class="material-icons right">send</i>
                        </button>
                    </center>
        </form>
@endsection
