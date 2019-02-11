<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	@include('include/head')
	<link rel="stylesheet" href="{!! asset('css/main.css') !!}">
	<style type="text/css">
	</style>
</head>
<body>
	@include('include/header')
	@include('include/sidebar')
		@yield('content')
		<script src="{!! asset('js/main.js') !!}"></script>
		@yield('script')
		<script type="text/javascript">
			$(document).ready(function(){
				$('#logout').click(function(e){
					e.preventDefault(this);
					$('#form').submit();
				});
			});
		</script>
	@include('include/footer')
</body>
</html>