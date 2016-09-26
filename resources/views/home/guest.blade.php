@extends('layouts.layout')

@section('title', 'Tabel Sekolah')
@section('head')
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
@endsection
@section('content')
        <!--tab SMP, SMA-->
    <div class="container">
        <div class="row">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col m3 s12"><a id="tab_fn" class="teal-text" href="#smp">SMP</a></li>
                    <li class="tab col m3 s12"><a id="tab_fl" class="teal-text" href="#sma">SMA</a></li>
                    <div class="indicator teal" style="z-index:1"></div>
                </ul>
            </div>
        </div>
    </div>
    <!--^^^^^^^^^^^^^^^^^^^^^^^^^-->
    <div class="section white" id="smp" >
        <div class="container">
            <div class="row">
                @if(count($smp))
                    <div class="row">
                        <div class="col s12 m12 l12">

                            <a href="{{route('maps.all',['jenjang'=>'smp'])}}" class="waves-effect waves-light btn blue right">lihat Peta</a>
                        </div>
                    </div>
                @endif
                <table class="highlight">
                    <thead>
                    <tr>
                        <th rowspan="2" data-field="id">NPSN</th>
                        <th rowspan="2" data-field="nama">Nama Sekolah</th>
                        <th rowspan="2" data-field="alamat"><center>Alamat</center></th>
                        <th rowspan="2" data-field="jenjang"><center>Jenjang</center></th>
                        <th rowspan="2" data-field="kecamatan"><center>Kecamatan</center></th>
                        <th colspan="2" data-field="psgrade"><center>Passing Grade</center></th>
                    </tr>
                    <tr>
                        <th data-field="kecamatan"><center>Tahun 2015</center></th>
                        <th data-field="psgrade"><center>Tahun 2016</center></th>
                    </tr>
                    </thead>
                    @forelse($smp as $dataSM)
                        <tbody>
                        <tr>
                            <td>{{$dataSM->npsn}}</td>
                            <td>{{$dataSM->nama}}</td>
                            <td>{{$dataSM->alamat}}</td>
                            <td>{{$dataSM->jenjang}}</td>
                            <td>{{$dataSM->kecamatan->nama}}</td>
                            <td>
                                <ul class="collection">
                                    <li class="collection-item red lighten-4"><center>{{$dataSM->psgrade15low}}</center></li>
                                    <li class="collection-item green lighten-4"><center>{{$dataSM->psgrade15high}}</center></li>
                                </ul>
                            </td>
                            <td>
                                <ul class="collection">
                                    <li class="collection-item red lighten-4"><center>{{$dataSM->psgrade16low}}</center></li>
                                    <li class="collection-item green lighten-4"><center>{{$dataSM->psgrade16high}}</center></li>
                                </ul>
                            </td>
                            <td><a href="{{ route('map.sekolah',['npsn'=>$dataSM->npsn])}}" class="waves-effect waves-light btn green black-text">peta</a></td>
                        </tr>

                        @empty
                            <center><h3 class="red-text">No School</h3></center>
                        @endforelse
                        </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="section white" id="sma" >
        <div class="container">
            <div class="row">
                @if(count($sma))
                    <div class="row">
                        <div class="col s6 m12 l12">

                            <a href="{{route('maps.all',['jenjang'=>'sma'])}}" class="waves-effect waves-light btn blue right">lihat Peta</a>
                        </div>
                    </div>
                @endif
                <table class="highlight">
                    <thead>
                    <tr>
                        <th data-field="id">NPSN</th>
                        <th data-field="nama">Nama Sekolah</th>
                        <th data-field="alamat">Alamat</th>
                        <th data-field="jenjang">Jenjang</th>
                        <th data-field="kecamatan">Kecamatan</th>
                    </tr>
                    </thead>
                    @forelse($sma as $dataSM)
                        <tbody>
                        <tr>
                            <td>{{$dataSM->npsn}}</td>
                            <td>{{$dataSM->nama}}</td>
                            <td>{{$dataSM->alamat}}</td>
                            <td>{{$dataSM->jenjang}}</td>
                            <td>{{$dataSM->kecamatan->nama}}</td>
                            <td><a href="{{ route('edit.school',['npsn'=>$dataSM->npsn])}}" class="waves-effect waves-light btn green black-text">ubah</a></td>
                        </tr>
                        @empty
                            <center><h3 class="red-text">No School</h3></center>
                        @endforelse
                        </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container center">
            {!! (new App\Pagination($smp))->render() !!}
        </div>
    </div>
    <script>
        function peta(npsn) {
            window.location = "/sekolah/"+npsn+"/lokasi";
        }
        function apus(e) {
            if (confirm('Hapus Sekolah?')) {
                //$(this).prev('span.text').remove();
                $(e).closest('form').submit();
            }
        }
        $(document).ready(function() {
            $('#sec_con').hover(function () {
                        $(this).css('cursor','pointer');
                        $(this).css('cursor','hand');
                    },function () {
                        $(this).css('cursor','auto');
                    }
            )
            $('#sec_cona').hover(function () {
                        $(this).css('cursor','pointer');
                        $(this).css('cursor','hand');
                    },function () {
                        $(this).css('cursor','auto');
                    }
            )
        });
    </script>
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