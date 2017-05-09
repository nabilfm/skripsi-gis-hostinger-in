@extends('layouts.layout')

@section('title', 'Beranda')
@section('head')
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    @if(!Auth::check())
        <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
        <style>
            #mapid { height:500px; }
            @media only screen and (min-device-width : 320px) and (max-device-width : 480px) {
                #mapid { height:250px; }
            }
        </style>
    @endif
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="input-field col s12 center">
                <p id="desc_web" class="center white-text">SMP dan SMA Negeri di Depok</p>
            </div>
        </div>
    </div>
    @if(Auth::check())
        @include('home.admin')
    @else
        {{--@include('home.guest')--}}
        <div class="container">
            <div class="card z-depth-1">
                <center><div id="mapid"></div></center>
            </div>
        </div>
        <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
        <script>
            var mymap       = L.map('mapid').setView([-6.4178, 106.8197], 12);
            $(document).ready(function(){
//                L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                L.tileLayer('https://api.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                    maxZoom: 18,
                    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                    '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="http://mapbox.com">Mapbox</a>',
                    id: 'mapbox.streets',
//                    accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw'
                    accessToken: 'pk.eyJ1IjoibmFiaWxmbSIsImEiOiJjaW5iNGNrbHYwa285dWZsd2szM21xdTRhIn0.r3BuXfQVm-jVcVr5Gjc41Q'
                }).addTo(mymap);
            });
        </script>
    @endif

@endsection
@section('footer')
    <footer style="background-color: #0D47A1" class="page-footer">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">{{Lang::get('detail.about')}}</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="#!">Alamat Kantor</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Indonesia</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">email@email.com</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">876543210</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                © 2016 Copyright
                <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
            </div>
        </div>
    </footer>
@endsection