@extends('layout.app')

@section('page-style')
	<style>
	   img#imgPreview {
	       max-width: 200px;
	       max-height: 200px;
	   }
	  
	</style>
@endsection

@section('title-page')
	<h4><i class="icon-menu6 position-left"></i>Edit Post</h4>
@endsection

@section('page-body')
	<div class="row">

		@if ($info['info']['access_level'] === 'Admin')
			<a href="../posts" class="button btn btn-default heading-btn"><i class="icon-arrow-left32 position-left"></i>Back</a>
		@endif
		<div class="panel panel-default mt-20">
			<div class="panel-heading">
				<h6 class="panel-title">Edit Post</h6>
			</div>
			<div class="panel-body">
				<form class="form-horizontal"  id="formEditPost">

					<input type="hidden" name="_method" value="PUT">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					
					<div class="row mt-20">
						@if ( $post->type !== 'Meeting')
							
						@endif
						
						<div class="col-md-8">

							<div class="form-group">
								<label class="col-lg-3 control-label text-semibold">Implementor <small class="text-danger">*</small></label>
								<div class="col-lg-6">
									<div class="multi-select-full">
										<select class="multiselect" multiple="multiple" name="cboEditImplementor">
											@for ($i = 0; $i < count($departments); $i++)
											<optgroup label="{{ $departments[$i]['division'] }}">
												@for ($y = 0; $y < count($departments[$i]['departments']); $y++)
													<option value="{{ $departments[$i]['departments'][$y]['id'] }}" @foreach($post->implementors as $implementor){{$implementor === $departments[$i]['departments'][$y]['id'] ? 'selected': ''}}   @endforeach> {{ $departments[$i]['departments'][$y]['name'] }}</option>
												@endfor
											</optgroup>
											@endfor
										</select>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-3 control-label text-semibold">Title <small class="text-danger">*</small></label>
								<div class="col-lg-9">
									<input type="text" class="form-control" name="txtEditTitle" value="{{$post->title}}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-lg-3 control-label text-semibold">Description <small class="text-danger">*</small></label>
								<div class="col-lg-9">
									<textarea rows="6" cols="5" class="form-control" name="txtEditDescription">{{$post->description}}</textarea>
								</div>
							</div>

							<button type="submit" id="{{$post->id}}" class="btn btn-primary mt-20 btnEditPost">Edit <i class="icon-arrow-right14 position-right"></i></button>
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
			$('#sbPost').addClass('active');

			$('.checker').css('paddingTop', '3%');

			$(document).on('change', '[name=uploadEditImage]', function () {
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

			$(document).on('click', '.btnEditPost', function( e ) {
				let id = $(this).attr('id');
				$("#formEditPost").submit(function(e) {
					e.preventDefault();
				}).validate({
					rules: {
						txtEditTitle: {
							required: true
						},
						txtEditDescription: {
							required: true
						}
					},
					messages: {
						txtTitle: {
							required: 'Please Enter Post Title Name',
						},
						txtDescription: {
							required: 'Please Enter Post Description Name',
						}
					},
					submitHandler: function(form) {
						
						let selected = [];

						$('.multiselect :selected').each(function(){
							selected.push($(this).val());
						});

						let fd = new FormData($('#formEditPost')[0]);
						fd.append('image', $('[name=uploadEditImage]')[0].files[0]);
						fd.append('implementors', selected);
						$.ajax({
							url: '../posts/'+id,
							type: 'POST',
							processData: false,
							contentType: false,
							data: fd,
							success: function(response){
								if(response) {
									swal({
										title: "Success",
										text: "Post Successfully Updated!",
										type: "success",
										confirmButtonColor: "#00cc66"
									}, function() {
										window.location = '../posts';
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