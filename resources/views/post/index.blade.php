@extends('layout.app')

@section('page-style')
	<style>
	   img#imgPreview {
	       max-width: 200px;
	       max-height: 200px;
	   }

	   .hover-img {
	   	/*background-color: #000;*/
	   	color: #fff;
	   	display: inline-block;
	   	margin: 8px;
	   	max-width: 200px;
	   	min-width: 200px;
	   	overflow: hidden;
	   	position: relative;
	   	text-align: center;
	   	width: 100%;
	   }

	   .hover-img * {
	   	box-sizing: border-box;
	   	transition: all 0.45s ease;
	   }

	   .hover-img:before,
	   .hover-img:after {
	   	background-color: rgba(0, 0, 0, 0.5);
	   	border-top: 32px solid rgba(0, 0, 0, 0.5);
	   	border-bottom: 32px solid rgba(0, 0, 0, 0.5);
	   	position: absolute;
	   	top: 0;
	   	bottom: 0;
	   	left: 0;
	   	right: 0;
	   	content: '';
	   	transition: all 0.3s ease;
	   	z-index: 1;
	   	opacity: 0;
	   	transform: scaleY(2);
	   }

	   .hover-img img {
	   	vertical-align: top;
	   	max-width: 200px;
	   	backface-visibility: hidden;
	   }

	   .hover-img figcaption {
	   	position: absolute;
	   	top: 0;
	   	bottom: 0;
	   	left: 0;
	   	right: 0;
	   	align-items: center;
	   	z-index: 1;
	   	display: flex;
	   	flex-direction: column;
	   	justify-content: center;
	   	line-height: 1.1em;
	   	opacity: 0;
	   	z-index: 2;
	   	transition-delay: 0.1s;
	   	font-size: 24px;
	   	font-family: sans-serif;
	   	font-weight: 400;
	   	letter-spacing: 1px;
	   	text-transform: uppercase;
	   }

	   .hover-img:hover:before,
	   .hover-img:hover:after {
	   	transform: scale(1);
	   	opacity: 1;
	   }

	   .hover-img:hover > img {
	   	opacity: 0.7;
	   }

	   .hover-img:hover figcaption {
	   	opacity: 1;
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
				<h6 class="panel-title">New Post</h6>
			</div>
			<div class="panel-body">
				<form class="form-horizontal" action="../posts" method="POST" id="formPost">
				@csrf
					<div class="row mt-20">
						<div class="col-md-4 mt-20 text-center imageDoc">
							<span class="text-bold">Document Image</span>
	            		<input type="file" class="file-styled" name="uploadImage" accept="image/jpeg,image/png,jpg|png"><br/>

	            		<figure class="hover-img">
	            			<img id="imgPreview" src="../images/documents/default.jpg"/>
	            			<figcaption>
	            				<h3>150 X 150</h3>
	            			</figcaption>
	            		</figure>

	            		{{-- <div class="holder"><img id="imgPreview" src="../images/documents/default.jpg"/></div> --}}
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<label class="col-lg-3 control-label text-semibold">Type of Post <small class="text-danger">*</small></label>
								<div class="col-lg-6">
									<select class="bootstrap-select" name="cboPostType" data-width="100%">
										<option value="Process">Process</option>
										<option value="Form">Form</option>
										<option value="Meeting">Meeting</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-3 control-label text-semibold">Division <small class="text-danger">*</small></label>
								<div class="col-lg-6">
									<select class="bootstrap-select" name="cboDivision" data-width="100%">
										<option value="" disabled selected hidden>Select</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-3 control-label text-semibold">Department <small class="text-danger">*</small></label>
								<div class="col-lg-6">
									<select class="bootstrap-select" multiple="multiple" name="cboDepartment" data-width="100%">
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-3 control-label text-semibold">Title <small class="text-danger">*</small></label>
								<div class="col-lg-9">
									<input type="text" class="form-control" name="txtTitle" autocomplete="off">
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-3 control-label text-semibold">Description <small class="text-danger">*</small></label>
								<div class="col-lg-9">
									<textarea rows="6" cols="5" class="form-control" name="txtDescription" autocomplete="off"></textarea>
								</div>
							</div>

							<div class="form-group link">
								<label class="col-lg-3 control-label text-semibold">Link </label>
								<div class="col-lg-9">
									<input type="url" class="form-control" name="txtLink" autocomplete="off">
								</div>
							</div>

							<div class="form-group uploadFile">
								<label class="col-lg-3 control-label text-semibold">Upload File </label>
								<div class="col-lg-9">
									<input type="file" class="file-styled-primary" name="uploadFile">
								</div>
							</div>

							<button type="submit" class="btn btn-primary mt-20 btnSubmitPost">Submit <i class="icon-arrow-right14 position-right"></i></button>
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

			let filename = '';

			$('#navigation > li').removeClass('active');
			$('#sbPost').addClass('active');

			let toggleImageDoc = ( element ) => {
				element == 'Meeting' ? $('.imageDoc').hide() : $('.imageDoc').show();
			}

			let toggleFileUpload = ( element ) => {
				element == 'Meeting' ? $('.uploadFile').hide() : $('.uploadFile').show();
			}

			let toggleLink = ( element ) => {
				element == 'Meeting' ? $('.link').hide() : $('.link').show();
			}

			let hasLinkValue = ( hasValue ) => {
				hasValue ? $('.uploadFile').show() : $('.uploadFile').hide();
			}

			let divisions = () => {
				$.ajax({
					url: '{{ route('users.division') }}',
					type: 'GET',
					dataType: 'json',
					data: { _token: '{{csrf_token()}}' },
					success: function(response){
						response.forEach(data => {
							$('[name=cboDivision]').append(`<option value="${data['id']}">${data['name']}</option>`);
						})
						$('[name=cboDivision]').selectpicker("refresh");
					}
				})
			}

			let departments = (division) => {
				$.ajax({
					url: '{{ route('users.department') }}',
					type: 'GET',
					dataType: 'json',
					data: { id: division, _token: '{{csrf_token()}}' },
					success: function(response){
						$('[name=cboDepartment]').children().remove();
						response.forEach(data => {
							$('[name=cboDepartment]').append(`<option value="${data['id']}">${data['name']}</option>`);
						})
						$('[name=cboDepartment]').selectpicker("refresh");
					}
				})
			}

			divisions();

			$(document).on('change', '[name=cboDivision]', function() {
				departments($(this).val());
			})

			$(document).on('change', '[name=cboPostType]', function() {
				let value = $(this).val();
				toggleImageDoc(value);
				toggleFileUpload(value);
			});

			$(document).on('change copy paste cut', '[name=txtLink]', function() {
			    hasLinkValue(false);
			});

			$(document).on('keyup', '[name=txtLink]', function() {
				if($('[name=cboPostType]').val() != 'Meeting') {
					$(this).val() == '' ? hasLinkValue(true) : hasLinkValue(false);
				}
			});

			$(document).on('click', '[name=uploadFile]', function() {
				toggleLink('Meeting')
			});

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

			$(document).on('click', '.btnSubmitPost', function( event ) {
				let selected = [];
				$('[name=cboDepartment] :selected').each(function(){
					selected.push($(this).val());
				});
				let fd = new FormData($('#formPost')[0]);
				fd.append('image', $('[name=uploadImage]')[0].files[0]);
				fd.append('file', $('[name=uploadFile]')[0].files[0]);
				fd.append('implementors', selected);
				fd.append('_token', '{{csrf_token()}}');
				$("#formPost").submit(function(e) {
					e.preventDefault();
				}).validate({
					rules: {
						txtTitle: {
							required: true
						},
						txtDescription: {
							required: true
						},
					},
					messages: {
						txtTitle: {
							required: 'Please Enter Post Title',
						},
						txtDescription: {
							required: 'Please Enter Post Description',
						},
					},
					submitHandler: function(form) {
						$.ajax({
							url: '../posts',
							type: 'POST',
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
										let user = '{{ $info['info']['access_level'] }}';
										if( user == 'Admin') {
											window.location = '../posts';
										} else {
											window.location = '../dashboard';
										}
										
									});
								}
							}
						})
					}
				})				
			});

		})
	</script>

@endsection