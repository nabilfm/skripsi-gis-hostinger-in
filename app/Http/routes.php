<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('hash/{text}',[
    'uses'  => 'Pengontrol@hash',
    'as'    => 'hash'])->where('text','[A-Za-z0-9]+');

Route::get('tabel-sekolah',[
    'uses'  => 'kontrolSekolah@tabel',
    'as'    => 'tabel.sekolah'
]);

Route::get('peta-sekolah/jenjang/{jenjang}',[
    'uses'  => 'kontrolSekolah@peta',
    'as'    => 'maps.all'])->where('jenjang','[a-z]+');
Route::get('peta-sekolah/jenjang/{jenjang}/kecamatan/{kecamatan}',[
    'uses'  => 'kontrolSekolah@maps',
    'as'    => 'maps.per.kecamatan'])->where('jenjang','[a-z]+')->where('kecamatan','[0-9]+');
Route::get('sekolah/{npsn}/lokasi',[
    'uses'  => 'kontrolSekolah@mapsSingle',
    'as'    => 'map.sekolah'])->where('npsn','[0-9]+');
Route::get('sekolah/{npsn}/lokasi/arahkan',[
    'uses'  => 'kontrolSekolah@mapsSingle',
    'as'    => 'map.sekolah.arahkan'])->where('npsn','[0-9]+');

Route::group(['middleware' => ['web']],function(){
    Route::post('masuk',[
        'uses' 	=> 'kontrolAdmin@masukinUser',
        'as'	=> 'masuk']);
    Route::get('/',[
        'uses'  => 'Pengontrol@homeGIS',
        'as'    => 'home'
    ]);
});

Route::group(['middleware' => ['web','administrator']],function(){
    Route::group(['prefix'=>'admin'],function(){
        Route::get('/',[
            'uses'  => 'Pengontrol@home',
            'as'    => 'admin.home'
        ]);
    });
    Route::get('logout',[
        'uses'	=>'kontrolAdmin@keluarinUser',
        'as'	=>'logout']);
    Route::post('npsnv',[
        'uses'  => 'kontrolSekolah@cekavail',
        'as'    => 'validate.npsn'
    ]);
    Route::group(['prefix'=>'sekolah'],function(){
        Route::get('create',[
            'uses'  => 'kontrolSekolah@indexCreate',
            'as'    => 'create.school'
        ]);
        Route::post('create',[
            'uses'  => 'kontrolSekolah@Save',
            'as'    => 'school.new'
        ]);
        Route::get('{npsn}/edit',[
            'uses'  => 'kontrolSekolah@indexEdit',
            'as'    => 'edit.school'])->where('npsn','[0-9]+');
        Route::post('edit',[
            'uses'  => 'kontrolSekolah@Save',
            'as'    => 'school.update'
        ]);
        Route::post('delete',[
            'uses'  => 'kontrolSekolah@Delete',
            'as'    => 'school.delete'
        ]);
    });
});
Route::group(['middleware' => ['web','guest']],function(){
    Route::get('login',[
        'uses'	=> 	'Pengontrol@indexLogin',
        'as'	=>	'login'
    ]);
});

Route::get('about',[
    'uses'  => 'Pengontrol@about',
    'as'    => 'about'
]);
