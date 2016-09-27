@extends('layouts.signup')

@section('title','Sekolah')
@section('head')
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<script src="{{asset('smbr/js/forms.js')}}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet/1.0.0-rc.1/leaflet.css"/>

@endsection

@section('content')
	<div class="container col s12 m12 l12">
		<h3 class="white-text">{{$label}}</h3>
	</div>

	<div class="section" id="fg" style="background-color: white">
	@if($label === 'Sekolah Baru')
		<form action="{{route('school.new')}}" method="post" id="formSekolah" enctype="multipart/form-data">
	@elseif($label === 'Perbarui Sekolah')
		<form action="{{route('school.update')}}" method="post" id="formSekolah" enctype="multipart/form-data">
	@endif
			<div class="container" id="isi">
                <div class="row">
                    <div class="card z-depth-1">
                        <center><div id="mapid" style="height: 250px"></div></center>
                        <div class="card-content col s12">
                            <a id="locateMe" class="waves-effect waves-light btn blue left">Locate Me</a>
                        </div>
                    </div>
                </div>
					<div class="col s12">
						<div class="row">
                            <div class="col s12 m6 l6">
                                <label>Foto Sekolah</label>
                                @if($label === 'Perbarui Sekolah')
                                    @if(count($sekolah->gambar))
                                        <center><img id="imgPreview" src="{{ url($sekolah->gambar->path.$sekolah->gambar->filename)}}" style="width: 125px;height: 125px"></center>
                                    @endif
                                @else
                                    <center><img id="imgPreview" src="" style="width: 125px;height: 125px"></center>
                                @endif
                                <div class="file-field input-field">
                                    <div class="btn">
                                        <span>File</span>
                                        <input type="file" name="image" id="image" accept="image/*">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input name="namafile" class="file-path validate" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l6">
                                <div class="input-field col s12">
                                    <input id="SC_label" name="SC_label" type="text" maxlength="10" length="10" value="{{{$sekolah->npsn or ''}}}" required >
                                    <label for="SC_label">NPSN</label>
                                    <input type="hidden" class="ttes" name="ttes" value="{{{ $sekolah->npsn or '' }}}">
                                </div>
                                <div class="input-field col s12">
                                    <input id="SC_name" name="SC_name" type="text" maxlength="50" length="50" value="{{{$sekolah->nama or ''}}}" required >
                                    <label for="SC_name">Nama Sekolah</label>
                                </div>
                                <div class="input-field col s12">
                                    <input id="SC_address" name="SC_address" type="text" maxlength="50" length="50" value="{{{$sekolah->alamat or ''}}}" required >
                                    <label for="SC_address">Alamat</label>
                                </div>
                            </div>
                        </div>
						<div class="row">
						</div>
						<div class="row">
						</div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="latitude"
                                       placeholder="(contoh: -6.3232323)"
                                       name="lat"
                                       value="{{{$sekolah->latitude or "" }}}" type="text"
                                       maxlength="20" length="20" required >
                                <label for="latitude">Latitude</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="longitude" name="lon"
                                       placeholder="(contoh: 120.0231233)"
                                       value="{{{$sekolah->longitude or "" }}}" type="text"
                                       maxlength="20" length="20" required >
                                <label for="longitude">Longitude</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="SC_akreditasi" name="SC_akreditasi" type="text" maxlength="1" length="1" value="{{{$sekolah->akreditasi or ''}}}" required >
                                <label for="SC_akreditasi">Akreditasi</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="SC_kdpos" name="SC_kdpos" type="number" maxlength="5" length="5" value="{{{$sekolah->kdpos or ''}}}" required >
                                <label for="SC_kdpos">Kode Pos</label>
                            </div>
                        </div>
                        <div class="row">
                            <p>Passing grade</p>
                            <div class="input-field col s3">
                                <input id="SC_psgrade15low" name="SC_psgrade15low" type="number"step="0.01"  maxlength="5" length="5" value="{{{$sekolah->psgrade15low or ''}}}" >
                                <label for="SC_psgrade15low">Terendah 2015</label>
                            </div>
                            <div class="input-field col s3">
                                <input id="SC_psgrade15high" name="SC_psgrade15high" type="number" step="0.01" maxlength="5" length="5" value="{{{$sekolah->psgrade15high or ''}}}" >
                                <label for="SC_psgrade15high">Tertinggi 2015</label>
                            </div>
                            <div class="input-field col s3">
                                <input id="SC_psgrade16low" name="SC_psgrade16low" type="number" step="0.01" maxlength="5" length="5" value="{{{$sekolah->psgrade16low or ''}}}" >
                                <label for="SC_psgrade16low">Terendah 2016</label>
                            </div>
                            <div class="input-field col s3">
                                <input id="SC_psgrade16high" name="SC_psgrade16high" type="number" step="0.01" maxlength="5" length="5" value="{{{$sekolah->psgrade16high or ''}}}" >
                                <label for="SC_psgrade16high">Tertinggi 2016</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="SC_kelurahan" name="SC_kelurahan" type="text" maxlength="15" length="15" value="{{{$sekolah->kelurahan or ''}}}" required >
                                <label for="SC_kelurahan">Kelurahan</label>
                            </div>
                            <div class="input-field col s6">
                                @if($label==="Sekolah Baru")
                                    <select id="SC_kecamatan" name="SC_kecamatan">
                                        <option value="default" disabled>Choose your option</option>
                                        @foreach($selkec as $kc)
                                            <option value="{{$kc->id}}">{{$kc->nama}}</option>
                                        @endforeach
                                    </select>
                                    <label>Kecamatan</label>
                                @else
                                    <select id="SC_kecamatan" name="SC_kecamatan">
                                        <option value="default" disabled>Choose your option</option>
                                        @foreach($selkec as $kc)
                                            <option value="{{$kc->id}}" {{{$kc->id === $sekolah->kecamatan_id ? "selected":""}}}>{{$kc->nama}}</option>
                                        @endforeach
                                    </select>
                                    <label>Kecamatan</label>
                                @endif
                            </div>
                        </div>
						<div class="row">
							<div class="input-field col s12">
								<input id="SC_phone" name="SC_phone" type="text" maxlength="13" length="13" value="{{{$sekolah->phone or ''}}}" >
								<label for="SC_phone">Phone</label>
							</div>
						</div>
						<div class="row">
                            <div class="input-field col s12">
                                <input id="SC_fax" name="SC_fax" type="text" maxlength="10" length="13" value="{{{$sekolah->fax or ''}}}" >
                                <label for="SC_fax">Fax</label>
                            </div>
						</div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="SC_email" name="SC_email" type="text" maxlength="50" length="50" value="{{{$sekolah->email or ''}}}" >
                                <label for="SC_email">Email</label>
                            </div>
						</div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="SC_website" name="SC_website" type="text" maxlength="50" length="50" value="{{{$sekolah->website or ''}}}" >
                                <label for="SC_website">Website</label>
                            </div>
						</div>
                        <div class="row">
                            <div class="input-field col s6">
                                @if($label ==="Sekolah Baru")
                                    <select id="SC_jenjang" name="SC_jenjang" required>
                                        <option value="default" disabled selected>Choose your option</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA">SMA</option>
                                    </select>
                                    <label>Jenjang</label>
                                    {{--<p>--}}
                                        {{--<input class="with-gap" id="SC_jenjang_a" name="SC_jenjang" type="radio" required--}}
                                               {{--value="SMP"--}}
                                        {{--/>--}}
                                        {{--<div></div>--}}
                                        {{--<label for="SC_jenjang_a">SMP</label>--}}
                                    {{--</p>--}}
                                    {{--<p>--}}
                                        {{--<input class="with-gap" id="SC_jenjang_b" name="SC_jenjang" type="radio" required--}}
                                               {{--value="SMA"--}}
                                        {{--/>--}}
                                        {{--<div></div>--}}
                                        {{--<label for="SC_jenjang_b">SMA</label>--}}
                                    {{--</p>--}}
                                    {{--<input id="SC_jenjang" name="SC_jenjang" type="text" maxlength="3" length="3" value="{{{$sekolah->jenjang or ''}}}" required >--}}
                                    {{--<label for="SC_jenjang">Jenjang</label>--}}
                                    {{--jenjang--}}
                                @else
                                    <select id="SC_jenjang" name="SC_jenjang" required>
                                        <option value="default" disabled selected>Choose your option</option>
                                        <option value="SMP" {{{$sekolah->jenjang==="smp" ? "selected" : "" }}}>SMP</option>
                                        <option value="SMA" {{{$sekolah->jenjang==="sma" ? "selected" : "" }}}>SMA</option>
                                    </select>
                                    {{--<p>--}}
                                        {{--<input class="with-gap" id="SC_jenjang_a" name="SC_jenjang" type="radio" required--}}
                                               {{--value="SMP" {{{$sekolah->jenjang==="SMP" ? "selected" : "" }}}--}}
                                        {{--/>--}}
                                        {{--<label></label>--}}
                                        {{--<label for="SC_jenjang_a">SMP</label>--}}
                                    {{--</p>--}}
                                    {{--<p>--}}
                                        {{--<input class="with-gap" id="SC_jenjang_b" name="SC_jenjang" type="radio" required--}}
                                               {{--value="SMA" {{{$sekolah->jenjang==="SMA" ? "selected" : "" }}}--}}
                                        {{--/>--}}
                                        {{--<label for="SC_jenjang_b">SMA</label>--}}
                                    {{--</p>--}}
                                @endif
                            </div>
                            <div class="input-field col s6">
                                @if($label==="Sekolah Baru")
                                    <select id="SC_waktu" name="SC_waktu" required>
                                        <option value="default" disabled selected>Choose your option</option>
                                        <option value="Pagi" >Pagi</option>
                                        <option value="Siang" >Siang</option>
                                    </select>
                                    <label>Waktu</label>
                                @else
                                    <select id="SC_waktu" name="SC_waktu" required>
                                        <option value="default" disabled selected>Choose your option</option>
                                        <option value="Pagi" {{{$sekolah->waktu==="Pagi" ? "selected" : "" }}}>Pagi</option>
                                        <option value="Siang" {{{$sekolah->waktu==="Siang" ? "selected" : "" }}}>Siang</option>
                                        <option value="Kombinasi" {{{$sekolah->waktu==="Kombinasi" ? "selected" : "" }}}>Kombinasi</option>
                                        <option value="Sehari Penuh (65h/m)" {{{$sekolah->waktu==="Sehari Penuh (6 h/m)" ? "selected" : "" }}}>Sehari Penuh (5 h/m)</option>
                                        <option value="Sehari Penuh (6 h/m)" {{{$sekolah->waktu==="Sehari Penuh (6 h/m)" ? "selected" : "" }}}>Sehari Penuh (6 h/m)</option>
                                    </select>
                                    <label>Waktu</label>
                                {{--<input id="SC_waktu" name="SC_waktu" type="text" maxlength="5" length="5" value="{{{$sekolah->waktu or ''}}}" required >--}}
                                {{--<label for="SC_waktu">Waktu</label>--}}
                                {{--waktu--}}
                                @endif
                            </div>
                            {{--<div class="input-field col s4">--}}
                                {{--<input id="SC_status" name="SC_status" type="text" maxlength="10" length="10" value="{{{$sekolah->status or ''}}}" required >--}}
                                {{--<label for="SC_status">Status</label>--}}
                                {{--status--}}
                            {{--</div>--}}
                        </div>
						<div class="row">
							<div class="col s12 m8 l4">
								<input type="hidden" name="_token" value="{{ Session::token() }}">
								<a href="{{route('admin.home')}}" class="waves-effect waves-light btn red left">Cancel</a>
								<button class="waves-effect waves-light btn green right formButton" type="submit"
										name="action" >Save
								</button>
							</div>
						</div>
					</div>
				</div>
		</form>
	</div>

    <script src="https://cdn.jsdelivr.net/leaflet/1.0.0-rc.1/leaflet.js"></script>


    <script type="text/javascript">
  	$(document).ready(function(){
		var token = $('meta[name=csrf-token]').attr('content');
        var azzz = $('input.ttes').val();
        var mymap = L.map('mapid').setView([-6.4178, 106.8097], 12);
        var marker;
        var inpLat = $('input#latitude');
        var inpLon = $('input#longitude');

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgPreview').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function () {
            readURL(this);
        });


        $('div.isi').ready(function () {
            if(inpLat.val().length > 0 && inpLon.val().length > 0){
//                    alert('here');
                marker = L.marker([parseFloat(inpLat.val()), parseFloat(inpLon.val())]).addTo(mymap)
                        .bindPopup("here").openPopup();
                var group = new L.featureGroup([marker]);
                mymap.fitBounds(group.getBounds());
            }
        });
        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
            '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="http://mapbox.com">Mapbox</a>',
            id: 'mapbox.streets',
            accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw'
        }).addTo(mymap);
        var popup = L.popup();
        function onMapClick(e) {
//                popup
//                        .setLatLng(e.latlng)
//                        .setContent("You clicked the map at " + e.latlng.toString())
//                        .openOn(mymap);
            if (marker){
                mymap.removeLayer(marker);
            }
            marker = new L.marker(e.latlng, {draggable:'true'}).addTo(mymap)
                    .bindPopup("here").openPopup();
            marker.on('dragend', function (e) {
//                    alert(marker.getLatLng().lat +" "+marker.getLatLng().lng);
                marker.openPopup();
                inpLat.val(marker.getLatLng().lat);
                inpLon.val(marker.getLatLng().lng);
            });
            var m = marker.getLatLng();
            inpLat.val(m.lat);
            inpLon.val(m.lng);
        }
        function onLocationFound(e) {
            var radius = e.accuracy / 2;
            if (marker){
                mymap.removeLayer(marker);
            }
            marker = L.marker(e.latlng,{draggable:'true'}).addTo(mymap)
                    .bindPopup("You are within " + radius + " meters from this point").openPopup();
            marker.on('dragend', function (e) {
//                    alert(marker.getLatLng().lat +" "+marker.getLatLng().lng);
                marker.openPopup();
                $('input#latitude').val(marker.getLatLng().lat);
                $('input#longitude').val(marker.getLatLng().lng);
            });
            var m = marker.getLatLng();
            $('input#latitude').val(m.lat);
            $('input#longitude').val(m.lng);
        }
        function onLocationError(e) {
            alert(e.message);
        }


        mymap.on('locationfound', onLocationFound);
        mymap.on('locationerror', onLocationError);
        mymap.on('click', onMapClick);
        $('a#locateMe').click(function(e){
            mymap.locate({setView: true, maxZoom: 16});
        });




        /*
        validation
         */
        $("#formSekolah").validate({
            rules:{
                'SC_label': {
                    required: true,
                    maxlength:10,
                    remote: {
                        url: window.location.protocol + "//" + window.location.host + "/npsnv",
                        type: "post",
                        data:  {
                            'tmpnm': azzz,
                            '_token': token
                        }
                    }
                },
                'SC_name': {required: true,maxlength:50},
                'SC_address': {required: true,maxlength:50},
                'SC_kdpos': {required: true,maxlength:5},
                'SC_kelurahan': {required: true,maxlength:15,valueNotEquals:"default"},
                'SC_kecamatan': {required: true,maxlength:15,valueNotEquals:"default"},
                'SC_phone': {maxlength:13},
                'SC_fax': {maxlength:15},
                'SC_email': {maxlength:50},
                'SC_website': {url:true},
                'SC_jenjang': {valueNotEquals: "default"},
                'SC_waktu': {valueNotEquals: "default"},
                lat:{required: true, cekfloat: true},
                lon:{required: true, cekfloat: true}
            },
            messages:{
                'SC_label': {remote:"NPSN sudah terdaftar"},
                'SC_jenjang': {valueNotEquals:"Pilih salah satu"},
                'SC_waktu': {valueNotEquals:"Pilih salah satu"},
                lat: {cekfloat: "must be float/double value (ex: -2.321)"},
                lon: {cekfloat: "must be float/double value (ex: 162.122)"}
            },
            errorElement : 'div',
            errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    focusCleanup: true
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                // do other things for a valid form
//                $('button[type=submit], input[type=submit]').prop('disabled',true);
                $('button[type=submit]').prop('disabled',true);
                form.submit();
            }
        });
        $.validator.addMethod("cekfloat", function(value) {
            return /^[-]*[\d*\.\d+%?][-\d*\.\d+%?]*$/.test(value) // consists of only these
        });
        $.validator.addMethod("valueNotEquals", function(value, element, arg){
            return arg != value;
        }, "Value must not equal arg.");

        $('div#cc_user').click(function(){
			$(this).closest('form').submit();
		});
		$('a.klik').click(function(){
			$(this).closest('form').submit();
		});
		$('a#btn_del').click(function(){
			if (confirm('yakin?')) {
				$(this).closest('form').submit();
		    }
		});
	});
</script>
@endsection

@section('footer')
    	@include('template.footer-admin')
@endsection