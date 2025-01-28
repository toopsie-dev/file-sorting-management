@extends('layout.app')

@section('page-style')
@endsection

{{-- @section('title-page')
	<h4><i class="icon-menu6 position-left"></i>Posts</h4>
@endsection --}}

@section('page-body')
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h6 class="panel-title">Users</h6>
				<div class="heading-elements">
					<button type="button" class="btn bg-primary btn-sm" data-toggle="modal" data-target="#modalAddUser">Add User <i class="icon-user-plus position-right"></i></button>
					<a href="../users/remove" class="button btn bg-danger btn-sm">Retrieve<i class="icon-rotate-ccw3 position-right"></i></a>
				</div>
			</div>
			<div class="panel-body">
				<table class="table table-hovered table-striped" id="tableUsers">
					<thead>
						<tr>
							<th>Id</th>
							<th>Full Name</th>
							<th>Access Level</th>
							<th>Division</th>
							<th>Department</th>
							<th>Date Registered</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	{{-- new user modal --}}
	<div id="modalAddUser" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">Add User</h5>
				</div>

				<form id="formUser" action="#">
					<div class="modal-body">
						<div class="form-group">
							<div class="row">
								<div class="col-sm-5"></div>
								<div class="col-sm-3">
									<label>Access Level <span class="text-danger">*</span></label>
								</div>

								<div class="col-sm-4">
									<select class="bootstrap-select" name="cboAccessLevel" data-width="100%">
										<option value="Employee">Employee</option>
										<option value="Admin">Admin</option>
										<option value="Intern">Intern</option>
									</select>
								</div>

								
							</div>

							<hr>

							<h6 class="text-primary">FULLNAME</h6> 
							<div class="row mt-10">
								<div class="col-sm-6">
									<label>First name <span class="text-danger">*</span></label>
									<input type="text" name="txtFirstName" class="form-control" autocomplete="off">
								</div>

								<div class="col-sm-6">
									<label>Last name <span class="text-danger">*</span></label>
									<input type="text" name="txtLastName" class="form-control" autocomplete="off">
								</div>
							</div>

							<hr>
						</div>

						<div class="form-group">
							<h6 class="text-primary">ACCOUNT</h6> 
							<div class="row mt-10">
								<div class="col-sm-7">
									<label>Working Email <span class="text-danger">*</span></label>
									<input type="email" name="txtEmail" class="form-control" autocomplete="off">
								</div>

								<div class="col-sm-5">
									<label>Default Password</label>
									<input type="text" name="txtDefaultPassword" class="form-control" readonly>
								</div>
							</div>
						</div>

						<hr>

						<div class="form-group">
							<h6 class="text-primary">DEPARTMENT</h6>
							<div class="row mt-10">
								<div class="col-sm-6">
									<label>Division <span class="text-danger">*</span></label>
									<div class="col-xlg-6">
										<select class="bootstrap-select" name="cboDivision" data-width="100%">
										</select>
									</div>
								</div>

								<div class="col-sm-6">
									<label>Department <span class="text-danger">*</span></label>
									<div class="col-xlg-6">
										{{-- <div class="multi-select-full"> --}}
											<select class="bootstrap-select" multiple="multiple" name="cboDepartment" data-width="100%">
											</select>
										{{-- </div> --}}
									</div>
								</div>
							</div>
						</div>

						<hr>
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary btnSaveUser">Save User</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	{{-- edit user modal --}}
	<div id="modalEditUser" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h5 class="modal-title">Edit User</h5>
				</div>

				<form id="formEditUser" action="#">
					<div class="modal-body">
						<div class="form-group">
							<input type="hidden" name="_method" value="PUT">
							<input type="hidden" name="txtEditId">
							<div class="row">
								<div class="col-sm-5"></div>
								<div class="col-sm-3">
									<label>Access Level <span class="text-danger">*</span></label>
								</div>

								<div class="col-sm-4">
									<select class="bootstrap-select" name="cboEditAccessLevel" data-width="100%">
										<option value="Admin">Admin</option>
										<option value="Employee">Employee</option>
										<option value="Intern">Intern</option>
									</select>
								</div>
							</div>

							<hr>

							<h6 class="text-primary">FULLNAME</h6> 
							<div class="row mt-10">
								<div class="col-sm-6">
									<label>First name <span class="text-danger">*</span></label>
									<input type="text" name="txtEditFirstName" class="form-control">
								</div>

								<div class="col-sm-6">
									<label>Last name <span class="text-danger">*</span></label>
									<input type="text" name="txtEditLastName" class="form-control">
								</div>
							</div>

							<hr>
						</div>

						<div class="form-group">
							<h6 class="text-primary">ACCOUNT</h6> 
							<div class="row mt-10">
								<div class="col-sm-7">
									<label>Working Email <span class="text-danger">*</span></label>
									<input type="email" name="txtEditEmail" class="form-control">
								</div>

								<div class="col-sm-5">
								</div>
							</div>
						</div>

						<hr>

						<div class="form-group">
							<h6 class="text-primary">DEPARTMENT</h6>
							<div class="row mt-10">
								<div class="col-sm-6">
									<label>Division <span class="text-danger">*</span></label>
									<div class="col-xlg-6">
										<select class="bootstrap-select" name="cboEditDivision" data-width="100%">
											 <option value="" disabled selected hidden>Select</option>
										</select>
									</div>
								</div>

								<div class="col-sm-6">
									<label>Department <span class="text-danger">*</span></label>
									<div class="col-xlg-6">
										{{-- <div class="multi-select-full"> --}}
											<select class="bootstrap-select" multiple="multiple" name="cboEditDepartment" data-width="100%">
											</select>
										{{-- </div> --}}
									</div>
								</div>
							</div>
						</div>

						<hr>
					</div>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary btnSaveEditUser">Edit User</button>
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
			$('#sbUsers').addClass('active');

			// every last name concatinate to defaul password
			$(document).on('keyup', '[name=txtLastName]', function() {
				$('[name=txtDefaultPassword]').val($(this).val() + '!@#');
			})

			// table extensions buttons
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
							$('[name=cboDivision]').append(`<option value="${data['id']}">${data['name']}</option>`);
						})
						$('[name=cboDivision]').selectpicker("refresh");

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
						$('[name=cboDepartment]').children().remove();
						response.forEach(data => {
							$('[name=cboDepartment]').append(`<option value="${data['id']}">${data['name']}</option>`);
						})
						$('[name=cboDepartment]').selectpicker("refresh");

						$('[name=cboEditDepartment]').children().remove();
						response.forEach(data => {
							$('[name=cboEditDepartment]').append(`<option value="${data['id']}">${data['name']}</option>`);
						})

						
						for (let i = 0; i < selected.length; i++) {
							$(`[name=cboEditDepartment] > [value=${selected[i]['department_id']}]`).attr('selected', true);
						}

						$('[name=cboEditDepartment]').selectpicker("refresh");
					}
				})
			}

			// datatable for users
			let tableUsers = $('#tableUsers').DataTable({
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
					url: "{{ route('users.active') }}"
				},
				columns: [
					{ data: 'id'},
					{ data: 'first_name'},
					{ data: 'access_level'},
					{ data: 'division'},
					{ data: 'departments'},
					{ data: 'date'},
					
				],
				columnDefs: [
					{
						targets: [0, 5],
						visible: false,
						searchable: false
					},
					{
						targets: 1,
						render:  function ( data, type, row, meta ) {
							return row['first_name'] + ' ' + row['last_name'];
						}
					},
					{
						targets: 6,
						className: 'text-center',
						render:  function ( data, type, row, meta ) {
							return `<button id="${row['id']}" type="button" class="btn btn-xs bg-success-300 btn-icon btnEditUser"><i class="icon-pencil5"></i></button>&nbsp;<button id="${row['id']}" type="button" class="btn btn-xs bg-danger-300 btn-icon btnRemoveUser"><i class="icon-trash"></i></button>&nbsp;<button id="${row['id']}" type="button" class="btn btn-xs bg-teal-300 btn-icon btnResetPassword"><i class=" icon-key"></i></button>`;
						}
					},
				]
			});

			divisions();
			tableExtensions();

			// change the item of departments under division
			$(document).on('change', '[name=cboDivision]', function() {
				departments($(this).val(), []);
			})

			// change the edit user item of departments under division
			$(document).on('change', '[name=cboEditDivision]', function() {
				departments($(this).val(), []);
			})

			// submit new user
			$('.btnSaveUser').click(function() {
				$("#formUser").submit(function(e) {
					e.preventDefault();
				}).validate({
					rules: {
						txtFirstName: {
							required: true,
							maxlength: 50,
							lettersonly: true,
						},
						txtLastName: {
							required: true,
							maxlength: 50,
							lettersonly: true,
						},
						txtEmail: {
							required: true,
							email: true
						},
					},
					messages: {
						txtFirstName: {
							required: 'Please Enter First Name',
							maxlength: 'First Name should not be more than 50 character'
						},
						txtLastName: {
							required: 'Please Enter Last Name',
							maxlength: 'Last Name should not be more than 50 character'
						},
						txtEmail: {
							required: 'Please Provide User Working Email',
							email: 'Not an Email format'
						},
					},
					submitHandler: function(form) {
						let selected = [];
						$('[name=cboDepartment] :selected').each(function(){
							selected.push($(this).val());
						});
						let fd = new FormData($('#formUser')[0]);
						fd.append('departments', selected);
						fd.append('_token', '{{csrf_token()}}');
						$.ajax({
							url: '../users',
							type: 'POST',
							processData: false,
							contentType: false,
							data: fd,
							success: function(response){
								if(response) {
									$('#modalAddUser').modal('hide');
									swal({
										title: "Success",
										text: "User Successfully Added!",
										type: "success",
										confirmButtonColor: "#00b359",
									}, function() {
										location.reload();
									});
								}
							}
						})
				  	}

				})
			}); 

			// edit user
			$(document).on('click', '.btnEditUser', function() {
				let id = $(this).attr('id');
				$.ajax({
					url: '{{ route('user.details') }}',
					type: 'GET',
					dataType: 'json',
					data: { id: id, _token: '{{csrf_token()}}' },
					success: function(response){
						$('#modalEditUser').modal('show');
						$('[name=txtEditId]').val(response['info']['id']);
						$('[name=txtEditFirstName]').val(response['info']['first_name']);
						$('[name=txtEditLastName]').val(response['info']['last_name']);
						$('[name=cboEditAccessLevel]').val(response['info']['access_level']);
						$('[name=cboEditAccessLevel]').selectpicker('refresh');
						$('[name=cboEditDivision]').val(response['info']['division_id']);
						$('[name=cboEditDivision]').selectpicker('refresh');
						$('[name=txtEditEmail]').val(response['account']['email']);
						departments(response['info']['division_id'], response['department']);
					}
				})
			})

			// remove user
			$(document).on('click', '.btnRemoveUser', function() {
				let id = $(this).attr('id');
				swal({
					title: "Are you sure?",
					text: "This user will be remove.",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, remove it!",
					closeOnConfirm: false,
					html: false
				}, function() {
					$.ajax({
						url: `../users/${id}`,
						type: 'DELETE',
						data: { _token: '{{csrf_token()}}' },
						success: function(response){
							swal("Success...", "User Successfully Removed!", "success");
							tableUsers.ajax.reload();
						}
					})

				});
			})

			// save edit user
			$(document).on('click', '.btnSaveEditUser', function() {
				$("#formEditUser").submit(function(e) {
					e.preventDefault();
				}).validate({
					rules: {
						txtEditFirstName: {
							required: true,
							maxlength: 50,
							lettersonly: true,
						},
						txtEditLastName: {
							required: true,
							maxlength: 50,
							lettersonly: true,
						},
						txtEditEmail: {
							required: true,
							email: true
						},
					},
					messages: {
						txtEditFirstName: {
							required: 'Please Enter First Name',
							maxlength: 'First Name should not be more than 50 character'
						},
						txtEditLastName: {
							required: 'Please Enter Last Name',
							maxlength: 'Last Name should not be more than 50 character'
						},
						txtEditEmail: {
							required: 'Please Provide User Working Email',
							email: 'Not an Email format'
						},
					},
					submitHandler: function(form) {
						let selected = [];
						$('[name=cboEditDepartment] :selected').each(function(){
							selected.push($(this).val());
						});
						let fd = new FormData($('#formEditUser')[0]);
						fd.append('departments', selected);
						fd.append('_token', '{{csrf_token()}}');
						$.ajax({
							url: '../users',
							type: 'POST',
							processData: false,
							contentType: false,
							data: fd,
							success: function(response){
								if(response) {
									$('#modalEditUser').modal('hide');
									swal("Success", "User Info Successfully Updated", "success");
									tableUsers.ajax.reload();
								}
							}
						})
					}
				})
			})

			$(document).on('click', '.btnResetPassword', function() {
				let id = $(this).attr('id');
				swal({
					title: "Are you sure?",
					text: "This user password will be reset.",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, reset it!",
					closeOnConfirm: false,
					html: false
				}, function() {
					$.ajax({
						url: '{{ route('users.reset') }}',
						type: 'GET',
						data: { id: id, _token: '{{csrf_token()}}' },
						success: function(response){
							swal({
								title: `Here's your new default password! ${response}`,
								confirmButtonColor: "#2196F3"
							});
						}
					})
				});
			})

		})

	</script>

@endsection