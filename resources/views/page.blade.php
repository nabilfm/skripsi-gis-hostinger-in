@extends('layouts.layout')

@section('title', 'Tentang Kami')

@section('sidebar')
	@parent

	<p>this is appended to master sidebar</p>
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="input-field col s12 center">
				<h3 id="desc_web" class="center white-text">Sekilas Tentang Kami</h3>
			</div>
		</div>
	</div>
	<div class="section white">
		<div class="container">
			<p style="text-align: justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec semper erat lectus. Integer dui libero, pellentesque in semper sed, gravida non ante. Curabitur aliquet porta placerat. Nullam consectetur venenatis neque nec sagittis. In pretium dolor metus, at auctor arcu finibus et. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin nec placerat felis. Vivamus porta laoreet tortor, vel tempor tortor mollis eget. Etiam ac purus tempor, viverra lectus vel, ultrices mi.

				Donec vestibulum dolor ac ex pellentesque, quis laoreet neque dapibus. In hac habitasse platea dictumst. Vivamus porta ex lacus, et vulputate nulla cursus quis. Phasellus sed neque id turpis vestibulum finibus nec et justo. Vivamus sed nulla id est tempus elementum pellentesque ut velit. Etiam vel sapien quis felis fringilla tempus consequat in nibh. Praesent in odio eget massa malesuada vehicula. Fusce vitae ante nec diam hendrerit congue eget eu augue. Praesent mauris elit, consequat eget sem quis, viverra venenatis eros. Pellentesque mattis fringilla lectus in pellentesque.

				Maecenas non libero gravida, porttitor lacus in, euismod lacus. Phasellus ornare dolor id commodo pulvinar. Curabitur consequat risus ac congue scelerisque. Duis ut pretium tortor, id porta urna. Morbi sit amet pharetra eros, at sollicitudin lacus. In tincidunt vestibulum urna id bibendum. Suspendisse gravida dolor vel facilisis pulvinar. Praesent eget magna a sapien mollis dignissim. Nullam sed urna at est euismod volutpat. Nam suscipit quam id felis rhoncus lobortis.

				Proin ut maximus eros. Ut imperdiet eget metus sit amet pretium. Mauris pharetra erat rhoncus ipsum ornare aliquet. Nulla purus enim, sollicitudin non elit in, luctus aliquam diam. In ac malesuada tellus, vitae hendrerit urna. Vestibulum suscipit enim ac nisi tincidunt egestas. In ut nisi sit amet nunc facilisis commodo. Aliquam facilisis hendrerit luctus. Phasellus ultricies dictum risus, in pellentesque neque iaculis sit amet. Maecenas maximus orci a convallis dictum. Vivamus ultricies ex risus, quis condimentum dui consectetur ac. Sed rutrum velit at orci bibendum rhoncus. Nullam sed eros dolor. Quisque vehicula dictum blandit.</p>
		</div>
	</div>
@endsection
@section('footer')
	@include('template.footer-admin')
@endsection