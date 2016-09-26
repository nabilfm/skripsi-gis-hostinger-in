{{--@if(Session::has('success'))--}}
{{--<div class="container">--}}
{{--<div class="row">--}}
{{--<div class="input-field col s12 center">--}}
{{--<p id="desc_web" class="center white-text">{{Session::get('success')}}addaaaaa</p>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--@else--}}
{{--<div class="container">--}}
{{--<div class="row">--}}
{{--<div class="input-field col s12 center">--}}
{{--<p id="desc_web" class="center white-text">{{Session::get('success')}} ga ada</p>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--@endif--}}


@if(\Auth::check())
        <!--fixed button checklist-->
<div id="fab_sc" class="fixed-action-btn">
    <a  href="{{route('create.school')}}" class="btn-floating btn-large red">
        <i class="large material-icons">add</i>
    </a>
</div>
<!--^^^^^^^^^^^^^^^^^^^^^^^^^-->
@endif

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
                        {{--<form id="form_fauna" action="{{route('delete.all.cl')}}" method="post" name="delete_form">--}}
                        {{--<a id="btn_del" data-position="bottom" data-delay="50" data-tooltip="delete this" class="waves-effect waves-light btn orange left tooltipped">Delete All</a>--}}
                        {{--<input type="hidden" name="lbluid" value="{{$user->id}}">--}}
                        {{--<input type="hidden" name="_token" value="{{ Session::token() }}">--}}
                        {{--</form>--}}
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
                        <th><center>Tahun 2015</center></th>
                        <th><center>Tahun 2016</center></th>
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
                            <td><a href="{{ route('edit.school',['npsn'=>$dataSM->npsn])}}" class="waves-effect waves-light btn green black-text">ubah</a></td>
                        </tr>
                {{--@if(\Auth::check())--}}
                    {{--<a href="{{ route('edit.school',['npsn'=>$dataSM->npsn])}}" class="black-text">--}}
                        {{--@else--}}
                            {{--<a href="{{ route('map.sekolah',['npsn'=>$dataSM->npsn])}}" class="black-text">--}}
                                {{--@endif--}}
                                {{--<div class="col s6 m6 l4">--}}
                                    {{--<div id="c_user" class="card-panel z-depth-1 hoverable">--}}
                                        {{--<div id="cc_user">--}}
                                            {{--<div class="card-content">--}}
                                                {{--<h5>{{$dataSM->nama}}</h5>--}}
                                            {{--</div>--}}
                                            {{--<div class="card-content">--}}
                                                {{--<span>{{$dataSM->alamat}}</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--@if(\Auth::check())--}}
                                            {{--<div id="del_user">--}}
                                                {{--<form id="form_user" action="{{route('deleteFg')}}" method="post" name="register_form">--}}
                                                {{--<form id="form_user" action="{{route('school.delete')}}" method="post" name="register_form">--}}
                                                    {{--<div class="card-content">--}}
                                                        {{--<span>{{$dataSM->npsn}}<a id="sec_con" class="secondary-content"><i class="material-icons" onclick="peta({{$dataSM->npsn}})">pin_drop</i><i class="material-icons" onclick="apus(this)">deletes</i></a></span>--}}
                                                        {{--<input type="hidden" name="_token" value="{{ Session::token() }}">--}}
                                                        {{--<input type="hidden" name="lblsc" value="{{$dataSM->npsn}}">--}}
                                                    {{--</div>--}}
                                                {{--</form>--}}
                                            {{--</div>--}}
                                        {{--@else--}}
                                            {{--<div id="del_user">--}}
                                                {{--<form id="form_user" action="{{route('deleteFg')}}" method="post" name="register_form">--}}
                                                {{--<div class="card-content">--}}
                                                    {{--<span>{{$dataSM->npsn}}</span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--@endif--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</a>--}}
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
                        {{--<form id="form_fauna" action="{{route('delete.all.cl')}}" method="post" name="delete_form">--}}
                        {{--<a id="btn_del" data-position="bottom" data-delay="50" data-tooltip="delete this" class="waves-effect waves-light btn orange left tooltipped">Delete All</a>--}}
                        {{--<input type="hidden" name="lbluid" value="{{$user->id}}">--}}
                        {{--<input type="hidden" name="_token" value="{{ Session::token() }}">--}}
                        {{--</form>--}}
                        <a href="{{route('maps.all',['jenjang'=>'sma'])}}" class="waves-effect waves-light btn blue right">lihat Peta</a>
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
                    </thead>
            @forelse($sma as $dataSM)
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
                            <td><a href="{{ route('edit.school',['npsn'=>$dataSM->npsn])}}" class="waves-effect waves-light btn green black-text">ubah</a></td>
                        </tr>
                {{--<a href="" class="black-text">--}}
                {{--@if(\Auth::check())--}}
                    {{--<a href="{{ route('edit.school',['npsn'=>$dataSM->npsn])}}" class="black-text">--}}
                        {{--@else--}}
                            {{--<a href="{{ route('map.sekolah',['npsn'=>$dataSM->npsn])}}" class="black-text">--}}
                                {{--@endif--}}
                                {{--<div class="col s6 m6 l4">--}}
                                    {{--<div id="c_user" class="card-panel z-depth-1 hoverable">--}}
                                        {{--<div id="cc_user">--}}
                                            {{--<div class="card-content">--}}
                                                {{--<h5>{{$dataSM->nama}}</h5>--}}
                                            {{--</div>--}}
                                            {{--<div class="card-content">--}}
                                                {{--<span>{{$dataSM->alamat}}</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--@if(\Auth::check())--}}
                                            {{--<div id="del_user">--}}
                                                {{--<form id="form_user" action="{{route('deleteFg')}}" method="post" name="register_form">--}}
                                                {{--<form id="form_user" action="{{route('school.delete')}}" method="post" name="register_form">--}}

                                                    {{--<div class="card-content">--}}
                                                        {{--<span>{{$dataSM->npsn}}<a id="sec_cona" class="secondary-content"><i class="material-icons" onclick="peta({{$dataSM->npsn}})">pin_drop</i><i class="material-icons" onclick="apus(this)">deletes</i></a></span>--}}
                                                        {{--<input type="hidden" name="_token" value="{{ Session::token() }}">--}}
                                                        {{--<input type="hidden" name="lblsc" value="{{$dataSM->npsn}}">--}}
                                                    {{--</div>--}}
                                                {{--</form>--}}
                                            {{--</div>--}}
                                        {{--@else--}}
                                            {{--<div id="del_user">--}}
                                                {{--<form id="form_user" action="{{route('deleteFg')}}" method="post" name="register_form">--}}
                                                {{--<div class="card-content">--}}
                                                    {{--<span>{{$dataSM->npsn}}</span>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--@endif--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</a>--}}
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