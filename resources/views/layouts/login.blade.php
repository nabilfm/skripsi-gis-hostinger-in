<html>
<head>
	<title>@yield('title')</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="shortcut icon" type="image/png" href="{{asset('smbr/img/favicon.png')}}"/>
    {{--<link type="text/css" rel="stylesheet" href="{{asset('smbr/css/login.css')}}"  media="screen,projection"/>--}}
    <style type="text/css">
        html,
        body {
            height: 100%;
        }
        html {
            display: table;
            margin: auto;
        }
        body {
            display: table-cell;
            vertical-align: middle;
        }
        #page-wrap {
            width: 350px;
        }
        .margin {
            margin: 0 !important;
        }
    </style>
        <!--mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!--Google Icon Font-->
        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <!--css-->
        <link href="{{asset('smbr/css/materialize.min.css')}}" type="text/css" rel="stylesheet"  media="screen,projection"/>
        <link href="{{asset('smbr/css/materialize.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
        {{--<link href="{{asset('smbr/css/style.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>--}}

        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="{{asset('smbr/js/jquery.min.js')}}"></script>
        <script src="{{asset('smbr/js/materialize.min.js')}}"></script>

    <script src="{{asset('smbr/js/ffLg.js')}}"></script>
    <script src="{{asset('smbr/js/forms.js')}}"></script>
    <script src="{{asset('smbr/js/dist/jquery.validate.js')}}"></script>
    <script src="{{asset('smbr/js/dist/additional-methods.js')}}"></script>
</head>

<body bgcolor="#0D47A1">

	{{--<div id="page-wrap" class="z-depth-2">--}}
	{{--<div id="login" class="row z-depth-2">--}}
        <div id="page-wrap">
            <div class="row">
                <div class="input-field col s12 center">
                    <img src="{{asset('smbr/img/logo_small.png')}}" alt="" class="responsive-img valign profile-image-login">
                    {{--<p class="center login-form-text">W3lessons - Material Design Login Form</p>--}}
                </div>
            </div>

            <div class="col s12 card-panel z-depth-2">
                @yield('content')
            </div>
        </div>
	{{--</div>--}}

</body>

</html>