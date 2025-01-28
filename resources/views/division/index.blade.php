@extends('layout.app')

@section('title-page')
	<h4><i class="icon-office position-left"></i>Divisions and Departments</h4>
@endsection

@section('page-body')
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h6 class="panel-title">Divisions</h6>
					<div class="heading-elements">
						<button id="btnCreate" type="button" class="btn btn-primary btn-sm btn-icon"><i class="icon-plus2" style="color: white"></i></button>
						<button id="btnDivisionAction" type="button" class="btn bg-grey btn-sm btn-icon"><i class="icon-gear" style="color: white"></i></button>
					</div>
				</div>
				
				<table class="table">
					<tbody id="tblDivision">
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-6 departmentList">
			
		</div>
	</div>
@endsection

@section('page-script')
	
	<script>
		$(document).ready(() => {

			let isDivisionAction = false;
			let isDepartmentAction = false;
			let activeId = 0, activeDivision = '';

			$('#navigation > li').removeClass('active');
			$('#sbDivision').addClass('active');

			let hideActions = ( element ) => {
				$('.divisionSettings').hide();
				$('.departmentSettings').hide();
				$(element).show();
			}

			let divisionList = () => {
				$('#tblDivision').children().remove();
				$.ajax({
					url: 'divisions/list',
					method: 'GET',
					dataType: 'json',
		        	success: function(response){
		        		response.forEach(division => {
		        			$('#tblDivision').append(
		        				`<tr>
									<td><a href="" id="${division.id}" name="${division.name}" class="division">${division.name}</a></td>
									<td class="text-right divisionSettings">
										<small><a href="" class="text-primary editDivision" id="${division.id}" name="${division.name}">Edit</a> |
										<a href="" class="text-danger deleteDivision" id="${division.id}">Delete</a></small>
									</td>
								</tr>`
		        			);
		        		})

		        		hideActions();
		        	}
				})
			}

			let departmentList = (id, name) => {
				$.ajax({
					url: `divisions/${id}`,
					type: 'GET',
					data: { _token: '{{csrf_token()}}' },
					dataType: 'json',
					success: function(response){
						$('.departmentList').children().remove();
						let output = '';
						response.forEach(department => {
							output += `
							<tr>
							<td>${department.name}</td>
							<td class="text-right departmentSettings">
							<a href="" id="${department.id}" name="${department.name}" class="text-primary editDepartment">Edit</a> |
							<a href="" id="${department.id}" class="text-danger deleteDepartment">Delete</a>
							</td>
							</tr>`
						})
						$('.departmentList').append(`
							<div class="panel panel-default">
							<div class="panel-heading">
							<h6 class="panel-title">${activeDivision}</h6>
							<small class="display-block">Department</small>
							<div class="heading-elements">
							<button id="${activeId}" name="${activeDivision}" type="button" class="btn btn-primary btn-sm btn-icon btnCreateDepartment"><i class="icon-plus2" style="color: white"></i></button>
							<button id="btnDepartmentAction" type="button" class="btn bg-grey btn-sm btn-icon"><i class="icon-gear" style="color: white"></i></button>
							</div>
							</div>
							<table class="table" id="tblDepartment">
							<tbody>
							${output}
							</tbody>
							</table>
							</div>
						`)
						hideActions();
					}
			   })
			}

			divisionList();

			$(document).on('click', '#btnDivisionAction', function() {
				if(isDivisionAction) {
					hideActions();
					isDivisionAction = false;
				} else {
					hideActions('.divisionSettings');
					isDivisionAction = true;
				}
			} )

			$(document).on('click', '#btnCreate', function () {
				if($('[name=txtDivision]').length != 0) {
					swal("Info", "Please fill up the provided field!", "info");
				} else {
					$('#tblDivision').append(
						`<tr>
							<td><input name="txtDivision" type="text" class="form-control input-lg"></td>
							<td>
								<div class="text-right">
									<button type="button" id="btnSaveDivision" class="btn btn-primary btn-icon"><i class="icon-check" style="color: white;"></i></button>&nbsp;
									<button type="button" id="btnRemoveDivision" class="btn btn-danger btn-icon"><i class="icon-cross3" style="color: white;"></i></button>
								</div>
							</td>
						</tr>`
					);
				}
			} );

			$(document).on('click', '#btnRemoveDivision', function () {
		 		$(this).parents('tr').remove();
			} );

			$(document).on( 'click', '#btnSaveDivision', function ( event ) {
				event.preventDefault();
				$.ajax({
					url: 'divisions',
		        	type: 'POST',
		        	data: { division : $('[name=txtDivision]').val(), _token: '{{csrf_token()}}' },
		        	success: function(response){
		        		if( response ) {
		        			swal({
		        				title: "Success",
								text: "Division Successfully Saved",
								type: "success"
							}, function() {
								divisionList();
		        			})
		        		}
		        		
		        	}
			   })
			} );

			$(document).on('click', '.editDivision', function( event ) {
				event.preventDefault();
				let id = $(this).attr('id');
				let name = $(this).attr('name');
				if($('[name=txtDivision]').length != 0) {
					swal("Info", "Can't edit multiple division!", "info");
				} else {
					$(this).parents('tr').html(
						`<td><input name="txtDivision" type="text" class="form-control input-lg" value="${name}"></td>
						<td>
							<div class="text-right">
								<button type="button" name="${name}" id="${id}" class="btn btn-primary btn-icon btnEditDivision"><i class="icon-compose" style="color: white;"></i></button>&nbsp;
								<button type="button" id="btnCancelEdit" class="btn btn-danger btn-icon"><i class="icon-trash" style="color: white;"></i></button>
							</div>
						</td>
					`);
				}
			} );

			$(document).on('click', '.btnEditDivision', function( event ) {
				event.preventDefault();
				let id = $(this).attr('id');
				let name = $(this).attr('name');
				if( name !== $('[name=txtDivision]').val() ) {
					$.ajax({
						url: `divisions/${id}`,
			        	type: 'PUT',
			        	data: { editDivision : $('[name=txtDivision]').val(), _token: '{{csrf_token()}}' },
			        	success: function(response){
			        		if( response ) {
			        			swal({
			        				title: "Success",
									text: "Division Successfully Updated",
									type: "success"
								}, function() {
									divisionList();
			        			})
			        		}
			        	}
				   })
				} else {
					swal("Info", "No changes found!", "info");
				}
			} )

			$(document).on('click', '#btnCancelEdit', function( event ) {
				event.preventDefault();
				divisionList();
			} );

			$(document).on('click', '.deleteDivision', function( event ) {
				event.preventDefault();
				let id = $(this).attr('id');
				swal({
					title: "Are you sure?",
					text: "This division remove from list!",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, delete it!",
				}, function() {
					$.ajax({
						url: `divisions/${id}`,
			         type: 'DELETE',
			         data: { _token: '{{csrf_token()}}' },
			         success: function(response){
			         	if(response) {
			         		swal("Success...", "Division Successfully Deleted!", "success");
			         		divisionList();
			         	}
			        	}
				   })
				});
			} );

			$(document).on('click', '.division', function( event ) {
				event.preventDefault();
				let id = $(this).attr('id');
				let name = $(this).attr('name');
				activeId = id;
				activeDivision = name;
				departmentList(id, name);
			} );

			$(document).on('click', '#btnDepartmentAction', function() {
				if(isDepartmentAction) {
					hideActions();
					isDepartmentAction = false;
				} else {
					hideActions('.departmentSettings');
					isDepartmentAction = true;
				}
			} )

			$(document).on('click', '.btnCreateDepartment', function() {
				if($('[name=txtDepartment]').length != 0) {
					swal("Info", "Please fill up the provided field!", "info");
				} else {
					$('#tblDepartment').append(
						`<tr>
							<td><input name="txtDepartment" type="text" class="form-control input-lg"></td>
							<td>
								<div class="text-right">
									<button type="button" class="btn btn-primary btn-icon btnSaveDepartment"><i class="icon-check" style="color: white;"></i></button>&nbsp;
									<button type="button" id="btnRemoveDepartment" class="btn btn-danger btn-icon"><i class="icon-cross3" style="color: white;"></i></button>
								</div>
							</td>
						</tr>`
					);
				}
			} );

			$(document).on('click', '.btnSaveDepartment', function( event ) {
				event.preventDefault();
				$.ajax({
					url: 'departments',
		        	type: 'POST',
		        	data: { department : $('[name=txtDepartment]').val(), id : activeId,  _token: '{{csrf_token()}}' },
		        	success: function(response){
		        		if( response ) {
		        			swal({
		        				title: "Success",
								text: "Department Successfully Added",
								type: "success"
							}, function() {
								departmentList(activeId, activeDivision);
		        			})
		        		}
		        	}
			   })
			} );

			$(document).on('click', '#btnRemoveDepartment', function() {
				$(this).parents('tr').remove();
			} )

			$(document).on('click', '.editDepartment', function( event ) {
				event.preventDefault();
				let id = $(this).attr('id');
				let name = $(this).attr('name');
				if($('[name=txtDepartment]').length != 0) {
					swal("Info", "Can't edit multiple department!", "info");
				} else {
					$(this).parents('tr').html(
						`<td><input name="txtDepartment" type="text" class="form-control input-lg" value="${name}"></td>
						<td>
							<div class="text-right">
								<button type="button" name="${name}" id="${id}" class="btn btn-primary btn-icon btnEditDepartment"><i class="icon-compose" style="color: white;"></i></button>&nbsp;
								<button type="button" id="btnCancelDepartment" class="btn btn-danger btn-icon"><i class="icon-trash" style="color: white;"></i></button>
							</div>
						</td>
					`);
				}
			} )

			$(document).on('click', '.btnEditDepartment', function( event ) {
				event.preventDefault();
				let id = $(this).attr('id');
				let name = $(this).attr('name');
				if( name !== $('[name=txtDepartment]').val() ) {
					$.ajax({
						url: `departments/${id}`,
			        	type: 'PUT',
			        	data: { editDepartment : $('[name=txtDepartment]').val(), _token: '{{csrf_token()}}' },
			        	success: function(response){
			        		if( response ) {
			        			swal({
			        				title: "Success",
									text: "Department Successfully Updated",
									type: "success"
								}, function() {
									departmentList(activeId, activeDivision);
			        			})
			        		}
			        	}
				   })
				} else {
					swal("Info", "No changes found!", "info");
				}
			} )

			$(document).on('click', '#btnCancelDepartment', function( event ) {
				event.preventDefault();
				departmentList(activeId, activeDivision);
			} );

			$(document).on('click', '.deleteDepartment', function( event ) {
				event.preventDefault();
				let id = $(this).attr('id');
				swal({
					title: "Are you sure?",
					text: "This department remove from list!",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, delete it!",
				}, function() {
					$.ajax({
						url: `departments/${id}`,
			         type: 'DELETE',
			         data: { _token: '{{csrf_token()}}' },
			         success: function(response){
			         	if(response) {
			         		swal("Success...", "Department Successfully Deleted!", "success");
			         		departmentList(activeId, activeDivision);
			         	}
			        	}
				   })
				});
			} );
						
		})
	</script>

@endsection