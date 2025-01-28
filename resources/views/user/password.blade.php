@extends('layout.app')

@section('page-body')
<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h6 class="panel-title">Change Password</h6>
		</div>
		<div class="panel-body">
			<form action="#" class="form-horizontal" id="form-change-pass">

				<div class="row">
					<div class="col-md-6 mt-20">
						<label>Current Password <span class="text-danger">*</span></label>
						<input type="password" name="current" class="form-control input-xlg">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 mt-20">
						<label>New Password <span class="text-danger">*</span></label>
						<input type="password" name="new" class="form-control input-xlg">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 mt-20">
						<label>Confirm Password <span class="text-danger">*</span></label>
						<input type="password" name="confirm" class="form-control input-xlg">
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 mt-20">
						<label class="checkbox-inline">
							<input type="checkbox" class="styled show-password">
							Show Password
						</label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 mt-20">
						<button type="submit" class="btn btn-primary">Save Changes</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('page-script')
	
	<script>
		$(document).ready(() => {

			$('#navigation > li').removeClass('active');
			
			$('[type=submit]').click(function(e){
				e.preventDefault();
				if($('#form-change-pass')[0].checkValidity()){

					let newPass = $('[name=new]').val();
					let confirmPass = $('[name=confirm]').val();

					let confirm = newPass === confirmPass ? true : false;

					if(confirm) {

						$.ajax({
							url: '{{ route('change.password') }}',
							type: 'GET',
							data: { new: newPass, old: $('[name=current]').val(), _token: '{{csrf_token()}}' },
							success: function(response){
								if(response) {
									swal({
										title: "Success",
										text: "Your password has been changed!",
										type: "success",
										confirmButtonColor: "#00cc66"
									}, function() {
										window.location = '../dashboard';
									});
								} else {
									swal("Can't Process", "Incorrect Current Password!", "error");
								}
								$('#form-change-pass')[0].reset();
							}
						})

					} else {
						swal("Oppss...", "Password do not match!", "error");
					}
				}
			});

			$('.show-password').click(() => {
				let current = $('[name=current]');
				let newPass = $('[name=new]');
				let confirm = $('[name=confirm]');
				current.attr("type") == "text" ? current.attr('type', 'password') : current.attr('type', 'text');
				newPass.attr("type") == "text" ? newPass.attr('type', 'password') : newPass.attr('type', 'text');
				confirm.attr("type") == "text" ? confirm.attr('type', 'password') : confirm.attr('type', 'text');
				current.attr("type") == "text" ? $(this).parent('span').addClass('checked') : $(this).parent('span').removeClass('checked');
				newPass.attr("type") == "text" ? $(this).parent('span').addClass('checked') : $(this).parent('span').removeClass('checked');
				confirm.attr("type") == "text" ? $(this).parent('span').addClass('checked') : $(this).parent('span').removeClass('checked');
			})


			
		})
	</script>

@endsection