<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

	<title>{{ config('app.name', 'Laravel') }}</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	{{-- CSRF Token --}}
	<meta name="csrf-token" content="{{ csrf_token() }}">

	{{-- Scripts --}}
    @stack('scripts')

    {{-- Styles --}}
    @stack('styles')

</head>

<body>
	
	<div id="app">

		<div>
			Navbar Here or something here
		</div>

		<main>
			@yield('content')
		</main>


	</div>

</body>

</html>