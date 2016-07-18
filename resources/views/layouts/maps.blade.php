<!--Header HTML code -->
<!DOCTYPE html>
  <html lang="en">
    <!--<base href="http://localhost/kh/"></base>-->
    <head>
    	<title>@yield('title')</title>
    	@include('template.head')
        @yield('head')
    </head>

    <body bgcolor="#26A69A">
			@yield('content')
    </body>
  </html>


<!--Footer HTML code-->