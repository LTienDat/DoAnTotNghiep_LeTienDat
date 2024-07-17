<!DOCTYPE html>
<html lang="en">
@include('head')
<body class="animsition">
	<!-- Header -->
@include('header')
	<!-- Cart -->
@include('cart')
@include('admin.alert')
	<!-- Slider -->

	@yield('content')
	
@include('footer')
</body>

</html>