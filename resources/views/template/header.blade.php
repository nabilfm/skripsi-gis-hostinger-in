<!-- Dropdown admin Structure -->
<ul id="admin" class="dropdown-content">
    <li><a href="{{route('admin.home')}}">Kelola Sekolah</a></li>
    <li class="divider"></li>
    <li><a href="{{route('logout')}}">Keluar</a></li>
</ul>
        <!--navigasi bar-->
            <div class="navbar-fixed">
                <nav style="background-color:#0D47A1"class ="lighten-1" role="navigation">
                    <div class="nav-wrapper container">
                        <a id="logo-container" href="{{url('')}}" class="brand-logo">WEBGIS</a>
            @if(Auth::check())
                        <ul class="right hide-on-med-and-down">
                            <li><a class="dropdown-button" href="#!" data-activates="admin">Admin<i class="material-icons right">arrow_drop_down</i></a></li>
                            <li><a href="{{route('home')}}">Beranda</a></li>
                            <li><a href="{{route('tabel.sekolah')}}">Tabel Sekolah</a></li>
                            <li><a href="{{route('about')}}">Tentang Kami</a></li>
                        </ul>
                        <ul id="nav-mobile" class="side-nav">
                            {{--<li><a class="dropdown-button" href="#!" data-activates="dropdown1">Admin<i class="material-icons right">arrow_drop_down</i></a></li>--}}
                            <li><a href="{{route('home')}}">Beranda</a></li>
                            <li><a href="{{route('tabel.sekolah')}}">Tabel Sekolah</a></li>
                            <li><a href="{{route('about')}}">Tentang Kami</a></li>
                        </ul>
                        <a href="#" data-activates="nav-mobile"
                           class="button-collapse"><i class="material-icons">menu</i>
                        </a>
            @else
                        <ul class="right hide-on-med-and-down">
                            <li><a href="{{route('login')}}">Masuk</a></li>
                            <li><a href="{{route('home')}}">Beranda</a></li>
                            <li><a href="{{route('tabel.sekolah')}}">Tabel Sekolah</a></li>
                            <li><a href="{{route('about')}}">Tentang Kami</a></li>
                        </ul>
                        <ul id="nav-mobile" class="side-nav">
                            <li><a href="{{route('login')}}">Masuk</a></li>
                            <li><a href="{{route('home')}}">Beranda</a></li>
                            <li><a href="{{route('tabel.sekolah')}}">Tabel Sekolah</a></li>
                            <li><a href="{{route('about')}}">Tentang Kami</a></li>
                        </ul>
                        <a href="#" data-activates="nav-mobile"
                           class="button-collapse"><i class="material-icons">menu</i>
                        </a>
            @endif
                    </div>        
                </nav>
                </div>
        <!--^^^^^^^^^^^^^^^^^^^^^^^^^^^-->
        

