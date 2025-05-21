<!DOCTYPE html>
<html lang="{{ app()->getlocale() }}">


<head>
	@include('website.components.head')
</head>

<body>
	<header>
		@include('website.components.header')
	</header>


	@yield('main')
	@include('website.components.footer')
	@include('website.components.scripts')
	@yield('scripts')
	<!--end::Page Scripts-->
</body>
<!--end::Body-->

</html>
