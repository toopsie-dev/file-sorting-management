@extends('layout.app')

@section('page-style')
	<style>
	   img#imgPreview {
	       max-width: 200px;
	       max-height: 200px;
	   }
	   img#imgPreview1 {
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

@section('title-page')
	<h4><i class="icon-menu6 position-left"></i>Revisions</h4>
@endsection

@section('page-style')
@endsection

@section('page-body')
	<div class="row">

		@if ($info['info']['access_level'] === 'Admin')
			<a href="{{ route('post.list') }}" class="button btn btn-default heading-btn"><i class="icon-arrow-left32 position-left"></i>Back</a><br/><br/>
		@endif
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h6 class="panel-title">Revisions</h6>
				<span class="text-right">{{ $revisions['implementors'] }}</span>
				<div class="heading-elements">
					@if ($info['info']['access_level'] !== 'Intern')
						<a href="" class="button btn btn-primary btnAddRevision">Add Revision</a>
					@endif
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<input type="hidden" name="txtId" value="{{ $revisions['post']['id'] }}">
					<div class="col-md-4 text-center">
						<img id="imgPreview" src="../../images/documents/{{$revisions['post']->image}}" style="max-width: 200px; max-height: 200px;" /><br/>
					</div>
					<div class="col-md-8">
						<span>{{ $revisions['post']['title'] }}</span><br/>
						<small>{{ $revisions['post']['type'] }}</small><br><br/>
						<span>{{ $revisions['post']['description'] }}</span><br/><br/>
						<a  href="{{ $revisions['latestDocument']['type'] == 'link' ? $revisions['latestDocument']['document'] : '../../files/' .$revisions['latestDocument']['document']}}" target="{{ $revisions['latestDocument']['type'] == 'link' ? '_blank': 'download'}}" class="button btn btn-primary heading-btn">View</a>
					</div>
				</div>
				<hr>
				<div class="row mt-20">
					<table class="table" id="tblRevisions">
						<thead>
							<tr>
								<th>Revision Id</th>
								<th>Document</th>
								<th>Type</th>
								<th>Revision Id</th>
								<th>Revisions</th>
								<th>Change By</th>
								<th>Date Revision</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				
			</div>
		</div>

		<!-- modal add revision -->
		<div id="modalAddRevision" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title">Add Revision</h5>
					</div>

					<form action="#" id="formRevision">
						<div class="modal-body">
							<div class="form-group">
								<div class="row">
									<div class="col-md-7 imageDoc">
										<span>Document Image</span>
										<input type="file" class="file-styled" name="uploadEditImage" accept="image/jpeg,image/png,jpg|png"><br/>
									</div>
									{{-- <div class="col-md-5">
										<div class="holder"><img id="imgPreview1" src="../../images/documents/{{$post->image}}" /></div>
									</div> --}}
									<figure class="hover-img">
										<img id="imgPreview1" src="../../images/documents/{{$post->image}}"/>
										<figcaption>
											<h3>150 X 150</h3>
										</figcaption>
									</figure>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-sm-12">
										<label>Title : <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="txtEditTitle" value="{{$post->title}}">
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-sm-12">
										<label>Revision : <span class="text-danger">*</span></label>
										<textarea rows="5" cols="5" class="form-control" name="txtRevision" autocomplete="off"></textarea>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-sm-12">
										<label>Revision No : <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="txtRevisionId" value="{{$post->count}}" readonly>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-sm-12">
										<label>Division <span class="text-danger">*</span></label>
										<div class="col-xlg-6">
										<select class="bootstrap-select" name="cboEditDivision" data-width="100%">
											 <option value="" disabled selected hidden>Select</option>
										</select>
									</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-sm-12">
										<label>Department <span class="text-danger">*</span></label>
										<div class="col-xlg-6">
											<select class="bootstrap-select" multiple="multiple" name="cboEditDepartment" data-width="100%">
											</select>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group link">
								<div class="row">
									<div class="col-sm-12">
										<label>Link : </label>
										<input type="url" class="form-control" name="txtLink" autocomplete="off">
									</div>
								</div>
							</div>

							<div class="form-group uploadFile">
								<div class="row">
									<div class="col-sm-12">
										<label>File : </label>
										<input type="file" class="file-styled-primary" name="uploadFile">
									</div>
								</div>
							</div>
						</div>

						<div class="modal-footer">
							<button type="submit" class="btn btn-primary btnSubmitRevision">Submit Revision</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	
@endsection

@section('page-script')
	
	<script>
		$(document).ready(() => {

			$('#navigation > li').removeClass('active');
			$('#sbPost').addClass('active');

			let tableExtensions = () => {
				$('.dataTables_filter input[type=search]').attr('placeholder','Type to filter...');
				$('.dataTables_length select').select2({
					minimumResultsForSearch: Infinity,
					width: 'auto'
				});
			}

			// list of all divisions
			let divisions = () => {
				$.ajax({
					url: '{{ route('users.division') }}',
					type: 'GET',
					dataType: 'json',
					data: { _token: '{{csrf_token()}}' },
					success: function(response){
						response.forEach(data => {
							$('[name=cboEditDivision]').append(`<option value="${data['id']}">${data['name']}</option>`);
						})
						$('[name=cboEditDivision]').selectpicker("refresh");
					}
				})
			}

			//list of all department based on selected division
			let departments = (division, selected) => {
				$.ajax({
					url: '{{ route('users.department') }}',
					type: 'GET',
					dataType: 'json',
					data: { id: division, _token: '{{csrf_token()}}' },
					success: function(response){
						$('[name=cboEditDepartment]').children().remove();
						response.forEach(data => {
							$('[name=cboEditDepartment]').append(`<option value="${data['id']}">${data['name']}</option>`);
						})

						for (let i = 0; i < selected.length; i++) {
							$(`[name=cboEditDepartment] > [value=${selected[i]}]`).attr('selected', true);
						}

						$('[name=cboEditDepartment]').selectpicker("refresh");
					}
				})
			}

			divisions();

			$(document).on('change', '[name=cboEditDivision]', function() {
				departments($(this).val(), []);
			})

			// add revisions
			$(document).on('click', '.btnAddRevision', function(e) {
				e.preventDefault();
				let id = {{ $post['id'] }};
				$('#modalAddRevision').modal('show');
				$('[name=cboEditDivision]').val( {{ $post['division_id'] }} );
				$('[name=cboEditDivision]').selectpicker('refresh');
				departments({{ $post['division_id'] }}, {{ $post['implementors'] }});
			})

			$(document).on('change', '[name=uploadEditImage]', function () {
				const file = this.files[0];
				if (file) {
					let reader = new FileReader();
					reader.onload = function (event) {
						$("#imgPreview1")
						.attr("src", event.target.result);
					};
					reader.readAsDataURL(file);
				}
			});

			let tblRevisions = $('#tblRevisions').DataTable({
				processing: true,
				serverSide: true,
				order: [[0, 'desc']],
				buttons: [
					{
						extend: 'print',
						text: '<i class="icon-printer position-left"></i> Print',
						className: 'btn btn-default',
						exportOptions: {
							columns: ':visible'
						}
					},
					{
						extend: 'colvis',
						text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
						className: 'btn btn-default btn-icon'
					},
				],
				ajax: {
					url: "{{ route('list.revisions') }}",
					type: 'get',
			   		data: { id : $('[name=txtId]').val() }
				},
				columns: [
					{ data: 'id'},
					{ data: 'document'},
					{ data: 'type'},
					{ data: 'revision_id'},
					{ data: 'changes'},
					{ data: 'change_by'},
					{ data: 'dateFormat'},
				],
				columnDefs: [
					{
			   			targets: [0, 2, 5],
			   			visible: false,
			   		},
			   		{
			   			targets: 1,
			   			render:  function ( data, type, row, meta ) {
			   				return row['type'] == 'file' ? '<a href="../../files/'+row['document']+'" target="download">'+row['document']+'</a>' : '<a href="'+row['document']+'" target="_blank">'+row['document']+'</a>';
	  					}
			   		},
				],
				drawCallback: function () {
					$(this).find('tbody tr').slice(2).find('.dropdown, .btn-group').addClass('dropup');
				}
			});

			tableExtensions();

			$(document).on('change copy paste cut', '[name=txtLink]', function() {
			   $('.uploadFile').hide()
			});

			$(document).on('click', '[name=uploadFile]', function() {
				$('.link').hide();
			});

			$(document).on('keyup', '[name=txtLink]', function(e) {
				e.preventDefault();
				$(this).val() != '' ? $('.uploadFile').hide() : $('.uploadFile').show();
			});


			let submitRevision = (condition) => {
				let id = {{ $post['id'] }};
				let selected = [];
				$('[name=cboEditDepartment] :selected').each(function(){
					selected.push($(this).val());
				});
				let fd = new FormData($('#formRevision')[0]);
				fd.append('image', $('[name=uploadEditImage]')[0].files[0]);
				fd.append('file', $('[name=uploadFile]')[0].files[0]);
				fd.append('implementors', selected);
				fd.append('_token', '{{csrf_token()}}');
				$("#formRevision").submit(function(e) {
					e.preventDefault();
				}).validate({
					rules: {
						txtEditTitle: {
							required: true
						},
						txtRevision: {
							required: true
						},
					},
					submitHandler: function(form) {
						$.ajax({
							url: `../../posts/${id}/revision`,
							type: 'POST',
							processData: false,
							contentType: false,
							data: fd,
							success: function(response){
								if(response) {
									swal({
										title: "Success",
										text: "Revision Successfully Added!",
										type: "success",
										confirmButtonColor: "#00cc66"
									}, function() {
										location.reload();
									});
								}
							}
						})
					}
				})
			}

			$(document).on('click', '.btnSubmitRevision', function( event ) {
				submitRevision(true);
				
			});

		})
	</script>

@endsection