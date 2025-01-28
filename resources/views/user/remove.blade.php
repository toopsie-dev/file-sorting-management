@extends('layout.app')

@section('page-style')
@endsection

{{-- @section('title-page')
	<h4><i class="icon-menu6 position-left"></i>Posts</h4>
@endsection --}}

@section('page-body')
	<div class="row">
		<a href="../users" class="button btn btn-default heading-btn"><i class="icon-arrow-left32 position-left"></i>Back</a><br/><br/>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h6 class="panel-title">Remove Users List</h6>
			</div>
			<div class="panel-body">
				<table class="table table-hovered table-striped" id="tableUsers">
					<thead>
						<tr>
							<th>Id</th>
							<th>Full Name</th>
							<th>Access Level</th>
							<th>Department</th>
							<th>Date Removed</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>

@endsection

@section('page-script')
	
	<script>
		$(document).ready(() => {

			$('#navigation > li').removeClass('active');
			$('#sbUsers').addClass('active');

			// table extensions buttons
			let tableExtensions = () => {
				$('.dataTables_filter input[type=search]').attr('placeholder','Type to filter...');
				$('.dataTables_length select').select2({
					minimumResultsForSearch: Infinity,
					width: 'auto'
				});
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
					url: "{{ route('users.inactive') }}"
				},
				columns: [
					{ data: 'id'},
					{ data: 'first_name'},
					{ data: 'access_level'},
					{ data: 'departments'},
					{ data: 'date'},
					
				],
				columnDefs: [
					{
						targets: [0, 4],
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
						targets: 5,
						render:  function ( data, type, row, meta ) {
							return `<button id="${row['id']}" type="button" class="btn bg-danger btn-sm btnRetrieve">Retrieve<i class="icon-rotate-ccw3 position-right"></i></button>`;
						}
					},
				]
			});

			tableExtensions();

			$(document).on('click', '.btnRetrieve', function() {
				let id = $(this).attr('id');
				swal({
					title: "Are you sure?",
					text: "This user will be retrieved.",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, retrieve it!",
					closeOnConfirm: false,
					html: false
				}, function() {
					$.ajax({
						url: '{{ route('users.retrieve') }}',
						type: 'GET',
						data: { id: id, _token: '{{csrf_token()}}' },
						success: function(response){
							swal("Success...", "User Successfully Removed!", "success");
							tableUsers.ajax.reload();
						}
					})

				});
			})



			
		})
	</script>

@endsection