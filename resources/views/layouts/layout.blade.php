<!--Header HTML code -->
<!DOCTYPE html>
  <html lang="en">
    <head>
    	<title>@yield('title')</title>
        <style>
            body {
                display: flex;
                min-height: 100vh;
                flex-direction: column;
            }

            main {
                flex: 1 0 auto;
            }
        </style>
    	@include('template.head')
        @yield('head')
    </head>

    <body bgcolor="#0D47A1">
    <header>
        @include('template.header')
    </header>
    <main>
        @yield('content')
    </main>
    @yield('footer')
    </body>
  </html>


<!--Footer HTML code-->