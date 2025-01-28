@extends('layout.app')


@section('page-style')
	<style>
	   img#imgPreview {
	       max-width: 200px;
	       max-height: 200px;
	   }
	  
	</style>
@endsection
{{-- @section('title-page')
	<h4><i class="icon-menu6 position-left"></i>Posts</h4>
@endsection --}}

@section('page-body')
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h6 class="panel-title">User Profile</h6>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" action="../posts" method="POST" id="formPost">
				@csrf
					<div class="row mt-20">
						<div class="col-md-4 mt-20 text-center imageDoc">

							<br/>
							<div class="holder"><img id="imgPreview" src="{{ $info['info']['img'] == null ? asset('images/profile/default.png') : asset('images/profile/'. $info['info']['img']) }}" /></div><br><br>
							<input type="file" class="file-styled" name="uploadImage" accept=".jpeg,.jpg,.png"><br/><br/>

							<button type="button" class="btn btn-primary btnUpload">Upload</button>
						</div>




						<div class="col-md-8">

							<div class="form-group">

								<h6 class="text-primary">FULLNAME</h6> 
								<div class="row mt-10">
									<div class="col-sm-6">
										<label>First name :</label>
										<input type="text" value="{{$info['info']['first_name']}}" class="form-control text-center" readonly>
									</div>

									<div class="col-sm-6">
										<label>Last name <span class="text-danger">*</span></label>
										<input type="text" value="{{$info['info']['last_name']}}" class="form-control text-center" readonly>
									</div>
								</div>

							</div>

							<hr>

							<div class="form-group">
								<h6 class="text-primary">DEPARTMENT</h6>
								<div class="row mt-10">
									<div class="col-sm-6">
										<label>Division :</label>
										<div class="col-xlg-6">
											<input type="text" value="{{$info['info']['division']['name']}}" class="form-control text-center" readonly>
										</div>
									</div>

									<div class="col-sm-6">
										<label>Department :</label>
										<div class="col-xlg-6">
											<input type="text" value="{{$info['info']['departments']}}" class="form-control text-center" readonly>
										</div>
									</div>
								</div>
							</div>

							<hr>

							<div class="form-group">
								<h6 class="text-primary">ACCOUNT</h6> 
								<div class="row mt-10">
									<div class="col-sm-7">
										<label>Working Email :</label>
										<input type="text" value="{{$info['info']['email']['email']}}" class="form-control text-center" readonly>
									</div>

									<div class="col-sm-5">
										<label>User type :</label>
										<input type="text" value="{{$info['info']['access_level']}}" class="form-control text-center" readonly>
									</div>
								</div>
							</div>
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
			
			$(document).on('change', '[name=uploadImage]', function () {
				const file = this.files[0];
				if (file) {
					let reader = new FileReader();
					reader.onload = function (event) {
						$("#imgPreview")
						.attr("src", event.target.result);
					};
					reader.readAsDataURL(file);
				}
			});

			$(document).on('click', '.btnUpload', function( event ) {
				event.preventDefault();
				let selected = [];
				let fd = new FormData();
				fd.append('image', $('[name=uploadImage]')[0].files[0]);
				fd.append('_token', '{{csrf_token()}}');
				$.ajax({
					url: '{{ route('upload') }}',
					method: 'POST',
					processData: false,
					contentType: false,
					data: fd,
					success: function(response){
						if(response) {
							swal({
								title: "Success",
								text: "Post Successfully Saved! Wait for approval. Thanks",
								type: "success",
								confirmButtonColor: "#00cc66"
							}, function() {
								window.location = '../dashboard';
							});
						}
					}
				})
			});

			
		})
	</script>

@endsection