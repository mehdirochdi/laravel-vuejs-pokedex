<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pokedox</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
	<link href='{{ asset(mix('css/app.css'))}}' rel="stylesheet">

	<style type="text/css">
		#app{
			font-family: 'Roboto', sans-serif;
		}

		/* body{
			background-color:#f3f6f2;
		}
		.v12-front--container{
			border-radius: 5px;
			-moz-border-radius: 5px;
			-webkit-border-radius: 5px;
			padding:10px;
		}

		.container{
			background-color:transparent;
		}

		@media only screen and (max-width: 599px){
			.container{
				padding:0 !important;
			}
		}

		.application.theme--light{
			background-color:transparent !important;
		} */
	</style>

	</head>
	<body>
		@routes
		<div id="vue-app">
			<v-app id="inspire">
        {{-- <v-progress-linear v-if="true"  :indeterminate="true" color="success" height="2"></v-progress-linear> --}}
				<header-component></header-component>
				@yield('content')
			</v-app>
		</div>
		<script>
			var url = '{{ url('/') }}'
		</script>
		<script src="{{ asset(mix('js/app.js'))}}" type="text/javascript"></script>
	</body>
</html>
