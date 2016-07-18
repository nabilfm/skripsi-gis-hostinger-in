<html>
    <head>
        <title>@yield('title')</title>
    </head>
    <body>
        @section('sidebar')
            this is the master sidebar
        @show
        <div class="container"></div>
            @yield('content')
    </body>
</html>