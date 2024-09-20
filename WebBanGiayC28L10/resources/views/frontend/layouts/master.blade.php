<!DOCTYPE html>
<html lang="zxx">
<head>
	@include('frontend.layouts.head')
</head>
<body>
	@include('frontend.layouts.header')
	<!--/ End Header -->
	@yield('main-content')

	@include('frontend.layouts.footer')
</body>
</html>
