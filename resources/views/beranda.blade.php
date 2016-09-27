@extends('layouts.layout')

@section('title', 'Beranda')

@section('head')
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    {{--@if(!Auth::check())--}}
        {{--<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />--}}
        <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
        <style>
            #mapid { height:370px; }
            @media only screen and (min-device-width : 320px) and (max-device-width : 480px) {
                #mapid { height:250px; }
            }
            .info {
                padding: 6px 8px;
                font: 14px/16px Arial, Helvetica, sans-serif;
                background: white;
                background: rgba(255,255,255,0.8);
                box-shadow: 0 0 15px rgba(0,0,0,0.2);
                border-radius: 5px;
            }
            li
            {
                list-style-type: none;
            }
            .info h4 {
                margin: 0 0 5px;
                color: #777;
            }
            .legend {
                line-height: 18px;
                color: #555;
            }
            .legend i {
                width: 18px;
                height: 18px;
                float: left;
                margin-right: 8px;
                opacity: 0.7;
            }
        </style>
    {{--@endif--}}
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="input-field col s12 center">
                {{--<img class="left" style="padding-top:2px; height: 5%; width: 5%;margin-right: 4px" src="{{asset('smbr/img/logo.png')}}">--}}
                <img class="center" style="height: 5%;width: 5%;" src="{{asset('smbr/img/logo.png')}}">
                <p id="desc_web" class="center white-text">Sebaran {{$tipe}} Negeri {{$keterangan}}Depok</p>
            </div>
        </div>
    </div>
    {{--@if(Auth::check())--}}
        {{--@include('home.admin')--}}
    {{--@else--}}
        {{--@include('home.guest')--}}
    @include('tambah')
        <div class="container">
            <div class="card z-depth-1">
                <center><div id="mapid"></div></center>
            </div>
            <div class="row">
                <div class="col s12 center">
                    <div class="input-field col s5">
                        <select id="SC_jenjang" name="SC_jenjang" required>
                            <option value="default" disabled selected>Choose your option</option>
                            <option value=1 {{{$jenjang==='smp' ? "selected":""}}}>SMP</option>
                            <option value=2 {{{$jenjang==='sma' ? "selected":""}}}>SMA</option>
                            <option value=3 {{{$jenjang==='semua' ? "selected":""}}}>SMP dan SMA</option>
                        </select>
                        <label>Jenjang</label>
                    </div>
                    <div class="input-field col s5">
                        <select id="SC_kecamatan" name="SC_kecamatan" required>
                            <option value="default" disabled selected>Choose your option</option>
                            <option value="0" {{{!$kecamatan ? "selected":""}}}>Semua Kecamatan</option>
                            @foreach($selkec as $kc)
                                <option value={{$kc->id}} {{{intval($kc->id) === intval($kecamatan) ? "selected":""}}}>{{$kc->nama}}</option>
                            @endforeach
                        </select>
                        <label>Kecamatan</label>
                    </div>
                    <div class="col s2">
                        <a id="btnPilih" class="waves-effect waves-light btn center green black-text">pilih</a>
                    </div>
                </div>
            </div>
        </div>
        {{--<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>--}}
        <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
        <script src="{{asset('smbr/js/leaflet/makimarkers/Leaflet.MakiMarkers.js')}}"></script>
        <script>
            var mymap       = L.map('mapid').setView([-6.4178, 106.8197], 12),
                    legend;
            var marker,icon,openpc,popupcontent,closepc;
            var arrmarker = [];
            var customOptions,maxzoom;
            var jenjang;
            var j = 0;
            var warna = ["","#22313F","#F62459","#9A12B3","#2574A9","#26A65B","#F7CA18","#F1A9A0","#F89406","#FDE3A7","#6C7A89","#86E2D5"];

            function direct(npsn){
                window.location = "/sekolah/"+npsn+"/lokasi/arahkan";
            }
            /* ganti halaman via js */
            function halaman(jjg,kec) {
                if (jjg===1) {
                    jenjang="smp";
                }else if(jjg===2){
                    jenjang="sma";
                }else if(jjg===3){
                    jenjang='semua';
                }else if(jjg===4 || !jjg){
                    jenjang='semua';
                }
                if (kec!=0) {
                    jenjang += '/kecamatan/' + kec;
                }
                window.location = "/peta-sekolah/jenjang/"+jenjang;
            }

            $(document).ready(function(){
                $('select').material_select();
                $('#btnPilih').on('click',function (event) {
                    var jskc = parseInt($('#SC_kecamatan').val());
                    var jsjj = parseInt($('#SC_jenjang').val());
                    halaman(jsjj,jskc);
                });
                if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                    // some code..
                    customOptions =
                    {
                        'maxHeight': '300',
                        'maxWidth': '400',
                        'className' : 'custom'
                    };
                    maxzoom=12;
                }else{
                    customOptions =
                    {
                        'maxHeight': '300',
                        'maxWidth': '700',
                        'className' : 'custom'
                    };
                    maxzoom=18;
                }

                L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                    maxZoom: maxzoom,
                    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                    '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="http://mapbox.com">Mapbox</a>',
                    id: 'mapbox.streets',
                    accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw'
                }).addTo(mymap);

                L.MakiMarkers.accessToken = "pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw";
                if (home) {
                    for (var i in kecamatan) {
                        var isi = kecamatan[i];
//                        alert(warna[isi['id']]);
                        icon = L.MakiMarkers.icon({icon: "town-hall", color: warna[isi['id']], size: "m"});
                        openpc ="<h5 class='teal-text center'>Kecamatan " + isi['nama']+ "</h5>"+
                                "<table class='centered striped'>"+
                                "<thead>"+
                                "<tr>"+
                                "<th data-field='jenjang'>Jenjang</th>"+
                                "<th data-field='total'>Jumlah</th>"+
//                            "<th data-field='lihat'></th>"+
                                "</tr>"+
                                "</thead>"+
                                "<tbody>";
                        popupcontent="<tr>"+
                                "<td>SMP</td>"+
//                            "<td>"+kecamatan.length+"</td>"+
                                "<td>"+jmlsmp[j]+"</td>"+
                                "<td><center><a class='waves-effect white-text waves-light center green btn-flat' onclick='halaman(1,"+isi['id']+");'>Lihat</a></center></td>"+
                                "</tr>" +
                                "<tr>"+
                                "<td>SMA</td>"+
//                            "<td>"+kecamatan.length+"</td>"+
                                "<td>"+jmlsma[j]+"</td>"+
                                "<td><center><a class='waves-effect white-text waves-light center green btn-flat' onclick='halaman(2,"+isi['id']+");'>Lihat</a></center></td>"+
                                "</tr>";
                        closepc= "</tbody>" +
                                        "</table>"+
                                        "<br><center><a class='waves-effect white-text waves-light center green btn-flat' onclick='halaman(3,"+isi['id']+");'>Lihat Semua</a></center>";
                        marker = L.marker([parseFloat(isi['latitude']), parseFloat(isi['longitude'])],{icon:icon}).addTo(mymap)
                                //                            .bindPopup(popupcontent,customOptions).openPopup();
                                .bindPopup(openpc+popupcontent+closepc,customOptions);
                        arrmarker.push(marker);
                        j++;
                    }
                    var legend = L.control({position: 'bottomright'});
                    legend.onAdd = function (map) {
                        var div    = L.DomUtil.create('div','info legend'),
                                grades= kecamatan,
                                labels=['<li><a class="teal-text"><i><img src="{{asset("smbr/img/ico/town-hall-11.svg")}}"></i> Kecamatan</a></li>'],from,to;
                        for (var i=0; i<grades.length;i++) {
                            from    = grades[i];
                            to      = grades[i+1]-1;
                            labels.push('<li><i style="background: '+warna[i+1]+'"></i> '+kecamatan[i].nama)+'</li>';
                        }
                        div.innerHTML = labels.join('<br>');
                        return div;
                    };
//                    legend.addTo(mymap);
                }else {
                    var ikon    = {smp:"commercial",sma:"college"};
                    var ikonlg  = {smp:"commercial-11.svg",sma:"college-11.svg"};
                    for (var xx in sekolah) {
                        var sc = sekolah[xx];
                        popupcontent = "<h5 class='teal-text center'>" + sc['nama']+ "</h5><p>" + sc['alamat']+ "</p>" +
                                "<center><img style='height: 100px; width: 100px;' src='"+window.location.protocol + "//" + window.location.host + "/"+gambar[xx]+"'></center>"+
                                "<table class='centered bordered'>"+
                                "<thead>"+
                                "<tr>"+
                                "<th data-field='id'>latitude</th>"+
                                "<th data-field='name'>longitude</th>"+
                                "</tr>"+
                                "</thead>"+
                                "<tbody>"+
                                "<tr>"+
                                "<td>"+sc['latitude']+"</td>"+
                                "<td>"+sc['longitude']+"</td>"+
                                "</tr>" +
                                "</tbody>" +
                                "</table>"+
                                "<p class='center'>Akreditasi <strong>"+sc['akreditasi']+"</strong></p>" +
                                "<br>" +
                                "<table class='centered bordered'>"+
                                "<thead>"+
                                "<tr>"+
                                "<th colspan='4'>Passing Grade</th>"+
                                "</tr>"+
                                "<tr>"+
                                "<th data-field='id'><center>Terendah 2015</center></th>"+
                                "<th data-field='name'><center>Tertinggi 2015</center></th>"+
                                "<th data-field='id'><center>Terendah 2016</center></th>"+
                                "<th data-field='name'><center>Tertinggi 2016</center></th>"+
                                "</tr>"+
                                "</thead>"+
                                "<tbody>"+
                                "<tr>"+
                                "<td>"+sc['psgrade15low']+"</td>"+
                                "<td>"+sc['psgrade15high']+"</td>"+
                                "<td>"+sc['psgrade16low']+"</td>"+
                                "<td>"+sc['psgrade16high']+"</td>"+
                                "</tr>" +
                                "</tbody>" +
                                "</table>"+
                                "<center><a class='waves-effect white-text waves-light center green btn-flat' onclick='direct("+sc['npsn']+");'>Arahkan</a></center>";
                        icon = L.MakiMarkers.icon({icon: ikon[sc['jenjang']], color: warna[sc['kecamatan_id']], size: "m"});
                        marker = L.marker([parseFloat(sc['latitude']), parseFloat(sc['longitude'])],{icon:icon})
                                .addTo(mymap)
                                //                            .bindPopup(popupcontent,customOptions).openPopup();
                                .bindPopup(popupcontent,customOptions);
                        arrmarker.push(marker);
                        legend = L.control({position: 'bottomright'});
                        legend.onAdd = function (map) {
                            var div    = L.DomUtil.create('div','info legend'),
                                    grades= selkec,
                                    labels=['<li><a class="teal-text"><i><img src="{{asset("smbr/img/ico/building-11.svg")}}"></i> SMP</a></li><li><a class="teal-text"><i><img src="{{asset("smbr/img/ico/college-11.svg")}}"></i> SMA</a></li>'],from,to;
                            for (var i=0; i<grades.length;i++) {
                                from    = grades[i];
                                to      = grades[i+1]-1;
                                labels.push('<li><i style="background: '+warna[i+1]+'"></i> Kec. '+selkec[i].nama)+'</li>';
                            }
                            div.innerHTML = labels.join('<br>');
                            return div;
                        };
                    }
                }
                legend.addTo(mymap);
                var group = new L.featureGroup(arrmarker);
                group.on('click', function () {
                    alert('yeay');
                });
                mymap.fitBounds(group.getBounds());
            });
        </script>
    {{--@endif--}}
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