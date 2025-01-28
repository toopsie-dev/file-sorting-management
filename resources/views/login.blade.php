
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - Gleentdocs</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">

	<link href="{{ asset('css/icons/icomoon/styles.css') }}" rel="stylesheet">
	<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('css/core.css') }}" rel="stylesheet">
	<link href="{{ asset('css/components.css') }}" rel="stylesheet">
	<link href="{{ asset('css/colors.css') }}" rel="stylesheet">


	<script type="text/javascript" src="{{ asset('js/plugins/loaders/pace.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/core/libraries/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/core/libraries/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/plugins/loaders/blockui.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/core/app.js') }}"></script>


	<script type="text/javascript" src="{{ asset('js/plugins/forms/styling/uniform.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/pages/form_inputs.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/plugins/notifications/sweet_alert.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/pages/login.js') }}"></script>

	<style>	
		@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
	/*	* {
			font-family: 'Poppins', sans-serif;
		}*/
		.logo {
			height: 120px;
		}
	</style>	

</head>

<body class="login-container">

	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- login form -->
					<form action="#" method="POST" id="formLogin">
						<div class="panel panel-body login-form">
							<div class="text-center">
								<img src="{{ asset('images/gleent-logo.png') }}" class="logo" alt="">
								<h5 class="content-group">Login to your account </h5>
							</div>

							<div id="error-message"></div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="text" name="txtEmail" class="form-control input-xlg"placeholder="Working Email" autocomplete="off">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" name="txtPassword" class="form-control input-xlg" placeholder="Password">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-6">
										<label class="checkbox-inline">
											<input type="checkbox" class="styled show-password">
											Show Password
										</label>
									</div>
									{{-- <div class="col-md-6 text-right">
										<a href="#">Forgot Password?</a>
									</div> --}}
								</div>
							</div>

							<div class="form-group">
								<button type="button" class="btn btn-primary btn-block btnLogin">Log In <i class="icon-circle-right2 position-right"></i></button>
							</div>
						</div>
					</form>
					<!-- /login form -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

	<script>
		$(document).ready(() => {
			let error = '';

			// showing password
			$('.show-password').click(() => {
				let password = $('[name=txtPassword]');
				password.attr("type") == "text" ? password.attr('type', 'password') : password.attr('type', 'text');
				password.attr("type") == "text" ? $(this).parent('span').addClass('checked') : $(this).parent('span').removeClass('checked');
			})

			// validate credentials
			$(document).on('click', '.btnLogin', function(e) {
				e.preventDefault();
				let email = $('[name=txtEmail]').val();
				let password = $('[name=txtPassword]').val();

				function alertMessage(message) {
					$('#error-message').html(
						`<div class="alert alert-danger no-border">
						<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
						${message}
				    </div>`);
				}

				if(email == '' && password == ''){
					alertMessage('Please enter your Working Email and Password.');
					error = 'IDPass';
				} else if(email == '') {
					alertMessage('Please enter your Working Email.');
					error = "Id";
				} else if(password == '') {
					alertMessage('Please enter your Password.');
					error = "Pass";
				}  else {
					if ($('#formLogin')[0].checkValidity()) {
						$.ajax({
							url: '{{ route('credentials') }}',
							type: 'GET',
							data: { email: email, password: password, _token: '{{csrf_token()}}' },
							success: function(response){
								switch (response) {
									case 'invalid':
										swal("Error", "Working Email Incorrect!", "error");
										break;
									case 'incorrect':
										swal("Error", "Password Incorrect!", "error");
										break;
									default:
										swal({
										    title: "Success",
										    text: "You are now successfully login.",
										    type: 'success',
										    html: true
										},
										function () {
										   window.location = 'dashboard';
										});
									break;
								}
							}
						})
					}
				}
			})

			$(document).on('keyup', '[name=txtEmail]', function(){
				let password = $('[name=txtPassword]').val();

				if(error == 'Id') {
					$('#error-message').children().remove();
				}
				if(error == 'IDPass') {
					if(password != '') {
						$('#error-message').children().remove();
					}
				}
			})

			$(document).on('keyup', '[name=txtPassword]', function(){
				let email = $('[name=txtEmail]').val();
				if(error == 'Pass') {
					$('#error-message').children().remove();
				}
				if(error = 'IDPass') {
					if(email != '') {
						$('#error-message').children().remove();
					}
				}
			})


		})
	</script>

</body>
</html>
