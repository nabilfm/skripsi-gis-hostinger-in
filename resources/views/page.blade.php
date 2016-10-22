@extends('layouts.layout')

@section('title', 'Tentang Kami')

@section('sidebar')
	@parent

	<p>this is appended to master sidebar</p>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="input-field col s12 center">
				<h3 id="desc_web" class="center white-text">Sekilas Tentang Kami</h3>
			</div>
		</div>
	</div>
	<div class="section white">
		<div class="container">
			<center><img src="http://nabilfm.esy.es/smbr/img/me.jpeg" alt="" style="width:10%"></center>
            			<p style="text-align: justify">
            			    Website Sistem Informasi Geografis dibangun untuk menyelesaikan Skripsi / Tugas Akhir di Universitas Gunadarma, Depok. Tujuannya yaitu agar membantu para orang tua untuk mengambil keputusan dalam memilih sekolah berdasarkan jarak. Selain itu, Website ini juga memberikan informasi mengenai Passing Grade SMP yang dari tahun 2015. Website ini dibangun menggunakan Laravel 5 PHP Framework, OpenStreetMap (Map Data), Leaflet JS (interaksi dengan peta), Leaflet routing-machine (petunjuk arah menuju lokasi Sekolah), MaterializeCSS Framework
            			</p>
		</div>
	</div>
@endsection
@section('footer')
	@include('template.footer-admin')
@endsection
