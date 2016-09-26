@extends('layouts.maps')
@section('title','Peta')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    {{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet/1.0.0-rc.1/leaflet.css"/>--}}
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
    <link rel="stylesheet" href="{{asset('smbr/js/leaflet/routing-machine/leaflet-routing-machine.css')}}" />
    <style>
        body {
            padding: 0;
            margin: 0;
        }
        html, body, #mapid {
            height: 100%;
        }
        .fixed-action-btn-cus {
            position: fixed;
            left: 23px;
            bottom: 23px;
            padding-top: 15px;
            margin-bottom: 0;
            z-index: 998;
        }
    </style>
@endsection

@section('content')
        <div id="mapid"></div>
    <!--fixed button desckripsi-->
        {{--<div id="fab_distribution" class="fixed-action-btn" style="bottom: 0px; right: 10px;">--}}
        <div id="fab_distribution" class="fixed-action-btn" >
            <div class="row">
                <div class="card-panel yellow" style="height:60px;">
                    <div class="card-content">
                        @if($all)
                            <span class="black-text">{{{$tipe or ""}}} di Depok</span>
                        @else
                            <span class="black-text">{{$sekolah->nama}}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    <!--^^^^^^^^^^^^^^^^^^^^^^^^^-->

    <!--fixed button back-->
        <div id="fab_distribution" class="fixed-action-btn" style="bottom: 0px; left: 10px; right:80%">
        <div id="fab_distribution" class="fixed-action-btn-cus">
            <div class="row">
                <div class="card-panel red" style="height:60px;">
                    <div class="card-content">
                        {{--<center><a href="{{route('home')}}" class="black-text"><i class="material-icons left">arrow_back</i>Back</a></center>--}}
                        <center><a href="{{URL::previous()}}" class="black-text"><i class="material-icons left">arrow_back</i></a><a href="{{route('home')}}" class="black-text"><i class="material-icons left">home</i></a></center>
                    </div>
                </div>
            </div>
        </div>
    <!--^^^^^^^^^^^^^^^^^^^^^^^^^-->
    @include('tambah')
        {{--<script src="https://cdn.jsdelivr.net/leaflet/1.0.0-rc.1/leaflet.js"></script>--}}
        <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
        <script src="{{asset('smbr/js/leaflet/routing-machine/leaflet-routing-machine.js')}}"></script>
        <script src="{{asset('smbr/js/leaflet/makimarkers/Leaflet.MakiMarkers.js')}}"></script>
        <script>
            var marker,icon;
            var mymap       = L.map('mapid').setView([-6.4178, 106.8297], 14);
            var rute        = null;
            var latlon      = [];
            var waypoints   = [];
            var ikon        = {smp:"commercial",sma:"college"};
            var warna       = ["","#F22613","#F62459","#9A12B3","#2574A9","#26A65B","#F7CA18","#F1A9A0","#F89406","#FDE3A7","#6C7A89","#86E2D5"];

            function onLocationFound(e) {
                if (marker){
                    mymap.removeLayer(marker);
                }
                if (rute){
                    rute.spliceWaypoints(rute.getWaypoints().length - 1, 1, latlon);
                    mymap.closePopup();
                }else {
                    var wpp = [L.latLng(e.latlng), L.latLng(latlon)];
                    mymap.closePopup();
                    rute = L.Routing.control({
                        waypoints: wpp,
                        createMarker: function (i, wp) {
                            if (wpp[1]) {
                                return L.marker(wp.latLng,{
                                    draggable: false
                                }).bindPopup("tes").openPopup();
                            }
                        },
//                        }),
                        draggableWaypoints: false,
                        routeWhileDragging: true,
                        lineOptions : {
                            addWaypoints: false
                        }
                    }).addTo(mymap);
                }
            }
            function popupContent(nama, alamat, latitude, longitude, pg15low, pg15high, pg16low, pg16high) {
                pc = "<h5 class='teal-text center'>" + nama + "</h5><p>" + alamat + "</p>" +
                        "<center><img style='height: 100px; width: 100px;' src='"+window.location.protocol + "//" + window.location.host + "/"+gambar+"'></center>"+
                        "<table class='centered bordered'>"+
                        "<thead>"+
                        "<tr>"+
                        "<th data-field='id'>latitude</th>"+
                        "<th data-field='name'>longitude</th>"+
                        "</tr>"+
                        "</thead>"+
                        "<tbody>"+
                        "<tr>"+
                        "<td>"+latitude+"</td>"+
                        "<td>"+longitude+"</td>"+
                        "</tr>" +
                        "</tbody>" +
                        "</table>"+
                        "<br/>"+
                        "<table class='centered bordered'>"+
                        "<thead>"+
                        "<tr>"+
                        "<th colspan='4'>Passing Grade</th>"+
                        "</tr>"+
                        "<tr>"+
                        "<th data-field='id'>Terendah 2015</th>"+
                        "<th data-field='name'>Tertinggi 2015</th>"+
                        "<th data-field='id'>Terendah 2016</th>"+
                        "<th data-field='name'>Tertinggi 2016</th>"+
                        "</tr>"+
                        "</thead>"+
                        "<tbody>"+
                        "<tr>"+
                        "<td>"+pg15low+"</td>"+
                        "<td>"+pg15high+"</td>"+
                        "<td>"+pg16low+"</td>"+
                        "<td>"+pg16high+"</td>"+
                        "</tr>" +
                        "</tbody>" +
                        "</table>"+
                        "<br><center><a class='waves-effect white-text waves-light center green btn-flat' onclick='menuju("+latitude+","+longitude+");'>Arahkan</a></center>";
                return pc;
            }
            function onLocationError(e) {
                alert(e.message);
            }
            function menuju(lat,lon) {
                latlon = [parseFloat(lat),parseFloat(lon)];
                mymap.on('locationfound', onLocationFound);
                mymap.on('locationerror', onLocationError);
                mymap.locate({setView: true, maxZoom: 12});
            }
            function direct(npsn){
                    window.location = "/sekolah/"+npsn+"/lokasi/arahkan";
            }
        $(document).ready(function () {
            // initialization
            var tkn = $('meta[name="csrf-token"]').attr('content');
            var customOptions =
            {
                'maxHeight': '400',
                'maxWidth': '400',
                'className' : 'custom'
            };

            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                maxZoom: 18,
                attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="http://mapbox.com">Mapbox</a>',
                id: 'mapbox.streets',
                accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw'
            }).addTo(mymap);
            L.MakiMarkers.accessToken = "pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw";

            if(all) {
                for (var i in lokasi) {
                    var isi = lokasi[i];
                    var popupcontent= "<h5 class='teal-text center'>" + isi['nama']+ "</h5><p>" + isi['alamat']+ "</p>" +
                            "<table class='centered bordered'>"+
                            "<thead>"+
                            "<tr>"+
                            "<th data-field='id'>latitude</th>"+
                            "<th data-field='name'>longitude</th>"+
                            "</tr>"+
                            "</thead>"+
                            "<tbody>"+
                            "<tr>"+
                            "<td>"+isi['latitude']+"</td>"+
                            "<td>"+isi['longitude']+"</td>"+
                            "</tr>" +
                            "</tbody>" +
                            "</table>"+
                            "<p class='center'>Akreditasi <strong>"+isi['akreditasi']+"</strong></p>" +
                            "<br>" +
                            "<center><a class='waves-effect white-text waves-light center green btn-flat' onclick='direct("+isi['npsn']+");'>Arahkan</a></center>";
                    icon = L.MakiMarkers.icon({icon: ikon[isi['jenjang']], color: warna[isi['kecamatan_id']], size: "m"});
                    marker = L.marker([parseFloat(isi['latitude']), parseFloat(isi['longitude'])],{icon:icon}).addTo(mymap)
                            .bindPopup(popupcontent,customOptions).openPopup();
                }
            }else{
                function button(label, container) {
                    var btn = L.DomUtil.create('button', '', container);
                    btn.setAttribute('type', 'button');
                    btn.setAttribute('class','waves-effect white-text waves-light center green btn-flat')
                    btn.innerHTML = label;
                    return btn;
                }
                mymap.on('click', function(e) {
                    var container = L.DomUtil.create('div'),
                            startBtn = button('Mulai dari sini', container);
//                            destBtn = button('Go to this location', container)

                    L.DomEvent.on(startBtn, 'click', function() {
                        rute.spliceWaypoints(0, 1, e.latlng);
                        mymap.closePopup();
                    });

//                    L.DomEvent.on(destBtn, 'click', function() {
//                        control.spliceWaypoints(control.getWaypoints().length - 1, 1, e.latlng);
//                        mymap.closePopup();
//                    });

                    L.popup()
                            .setContent(container)
                            .setLatLng(e.latlng)
                            .openOn(mymap);
                });
                if(arahkan) {
                    menuju(lokasi['latitude'],lokasi['longitude']);
                }else{
                    marker = L.marker([parseFloat(lokasi['latitude']), parseFloat(lokasi['longitude'])]).addTo(mymap)
                            .bindPopup(popupContent(lokasi['nama'],lokasi['alamat'],lokasi['latitude'],lokasi['longitude'],lokasi['psgrade15low'],lokasi['psgrade15high'],lokasi['psgrade16low'],lokasi['psgrade16high']),customOptions).openPopup();
                }

            }
        });
    </script>
@endsection