<!DOCTYPE html>
<html lang="en">

<head>
	<title>LLC</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="shortcut icon" href="{{ asset('/uploads/icons/frame.png')}}">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/authorize/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/authorize/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/authorize/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/authorize/vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/authorize/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/authorize/css/util.css">
	<link rel="stylesheet" type="text/css" href="/authorize/css/main.css">
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" style="text-align: center" data-tilt>
					<img  src="/uploads/icons/frame.png" alt="IMG">
				</div>

				<form method="POST" class="login100-form validate-form" action="{{ route('login', app()->getLocale()) }}">
					@csrf
					<span class="login100-form-title">
						<strong>
							{{trans('admin.user_login')}}
						</strong>
					</span>

					<div class="wrap-input100">
						{{-- <input class="input100" type="text" name="username" placeholder="username" id="username"> --}}
						<input class="input100" type="email" name="email" value="" placeholder="{{trans('admin.email')}}" id="email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>


					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password" placeholder="{{trans('admin.password')}}">
						
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
						@error('email')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							<strong>
								{{trans('admin.login')}}
							</strong>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>




	<!--===============================================================================================-->
	<script src="/authorize/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="/authorize/vendor/bootstrap/js/popper.js"></script>
	<script src="/authorize/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="/authorize/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="/authorize/vendor/tilt/tilt.jquery.min.js"></script>
	<script>
		$("#username").focusout(function(){
			$("#email").val($(this).val() + "@ltb.ge");
		});
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<!--===============================================================================================-->
	<script src="/authorize/js/main.js"></script>

</body>

</html>