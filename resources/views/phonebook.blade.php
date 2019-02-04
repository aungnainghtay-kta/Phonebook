<!DOCTYPE html>
<html>
<head>
	<title>Phone book</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>
<body>
<div id="app">
	<div class="container">

				<myheader></myheader>
				{{-- component to show vue data --}}
				<router-view></router-view>
				{{-- end component to show vue data --}}
				<myfooter></myfooter>

	</div>
</div>
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>
</html>