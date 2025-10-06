<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>E-commerce Website</title>
	@include('frontend.include.style')
</head>
<body>
	@include('frontend.include.header')
	<main>
        @yield('content')
	</main>
	@include('frontend.include.footer')
    @include('frontend.include.script')
	@stack('script')
</body>
</html>