@extends('layout.app')

@section('page-style')
@endsection

{{-- @section('title-page')
	<h4><i class="icon-menu6 position-left"></i>Posts</h4>
@endsection --}}

@section('page-body')
<div class="row">
	<div class="panel">
		<div class="panel-heading" style="background-color: #eff5f5;">
			<h6 class="panel-title text-bold">Dashboard / </h6> <span id='date-part'></span>
			<div class="heading-elements">
				
				<h6 id='time-part' class="display-inline-block"></h6>
			</div>
		</div>
		<div class="panel-body">
			<div class="row">
				
				<div class="col-lg-4 mt-20">
					<a href="{{ route('process') }}">
						<div class="panel bg-default-600">
							<div class="panel-body">
								<i class="icon-clipboard2 pull-left mt-10" style="font-size: 50px"></i>
								<div class="d-inline pull-left mt-10 ml-10">
									<span style="font-size: 2rem">Processes</span><br/>
									<span class="no-margin">Total</span>
								</div>
								<h1 class="d-inline pull-right totalProcesses"></h1>
							</div>
						</div>
					</a>
				</div>


				<div class="col-lg-4 mt-20">
					<a href="{{ route('form') }}">
						<div class="panel bg-default-600">
							<div class="panel-body">
								<i class="icon-notebook pull-left mt-10" style="font-size: 50px"></i>
								<div class="d-inline pull-left mt-10 ml-10">
									<span style="font-size: 2rem">Forms</span><br/>
									<span class="no-margin">Total</span>
								</div>
								<h1 class="d-inline pull-right totalForms"></h1>
							</div>
						</div>
					</a>
				</div>

				<div class="col-lg-4 mt-20">
					<a href="{{ route('meeting') }}">
						<div class="panel bg-default-600">
							<div class="panel-body">
								<i class="icon-menu6 pull-left mt-10" style="font-size: 50px"></i>
								<div class="d-inline pull-left mt-10 ml-10">
									<span style="font-size: 2rem">Meeting</span><br/>
									<span class="no-margin">Total</span>
								</div>
								<h1 class="d-inline pull-right totalMeetings"></h1>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

@if ($info['info']['access_level'] === 'Admin') 
<div class="row">
	<div class="panel">
		<div class="panel-heading" style="background-color: #eff5f5;">
			<h6 class="panel-title text-bold">New Post For Approval</h6>
		</div>
		<div class="panel-body">
			<table class="table" id="tblApprovalPosts">
				<thead>
					<tr>
						<th>Post Id</th>
						<th>Type</th>
						<th>Title</th>
						<th>Description</th>
						<th>Employee</th>
						<th>Division</th>
						<th>Implementors</th>
						<th>Date Created</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="row">
	<div class="panel">
		<div class="panel-heading" style="background-color: #eff5f5;">
			<h6 class="panel-title text-bold">Today Revision List</h6>
		</div>
		<div class="panel-body">
			<table class="table" id="tblRevision">
				<thead>
					<tr>
						<th>Revision Id</th>
						<th>Document</th>
						<th>Type</th>
						<th>Changes</th>
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
@endif

@if ($info['info']['access_level'] === 'Employee') 
<div class="row">
	<div class="panel">
		<div class="panel-heading" style="background-color: #eff5f5;">
			<h6 class="panel-title text-bold">Today Requesting for Approval</h6>
		</div>
		<div class="panel-body">
			<table class="table" id="tblRequesting">
				<thead>
					<tr>
						<th>Post Id</th>
						<th>Type</th>
						<th>Title</th>
						<th>Description</th>
						<th>Employee</th>
						<th>Division</th>
						<th>Implementors</th>
						<th>Date Created</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>
@endif

@endsection

@section('page-script')
	
	<script>
		$(document).ready(() => {

			let momentNow = moment();
			let interval = setInterval(function() {
				let momentNow = moment();
				let format = momentNow.format('hh:mm:ss a');
				$('#time-part').html(format);
			}, 100);
			$('#date-part').html(momentNow.format('MMMM DD, YYYY ') + momentNow.format('dddd')
				.substring(0,3));

			$('#navigation > li').removeClass('active');
			$('#sbDashboard').addClass('active');

			let tableExtensions = () => {
				$('.dataTables_filter input[type=search]').attr('placeholder','Type to filter...');
				$('.dataTables_length select').select2({
					minimumResultsForSearch: Infinity,
					width: 'auto'
				});
			}

			let tblApprovalPosts = $('#tblApprovalPosts').DataTable({
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
					url: "{{ route('approval.post') }}"
				},
				columns: [
					{ data: 'id'},
					{ data: 'type'},
					{ data: 'title'},
					{ data: 'description'},
					{ data: 'author'},
					{ data: 'division'},
					{ data: 'implementors'},
					{ data: 'date'}
				],
				columnDefs: [
				{
					targets: [0, 3, 5, 7],
					visible: false,
					searchable: false
				},
				{
					targets: 8,
					render:  function ( data, type, row, meta ) {
						return `<div class="text-center">
						<ul class="icons-list">
						<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-menu9"></i>
						</a>
						<ul class="dropdown-menu dropdown-menu-right">
						<li id="${row['id']}"  class="btnApprove"><a href="#"><i class="icon-checkmark3 text-success"></i>Approve</a></li>
						<li id="${row['id']}" class="btnCancel"><a href="#"><i class=" icon-cross2 text-danger"></i>Cancel</a></li>
						<li id=""><a href="posts/${row['id']}/revision"><i class="icon-list3 text-primary"></i>View</a></li>
						</ul>
						</li>
						</ul>
						</td>`;
					}
				}
				],
				drawCallback: function () {
					$(this).find('tbody tr').slice(2).find('.dropdown, .btn-group').addClass('dropup');
				}
			});

			let tblRevision = $('#tblRevision').DataTable({
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
					url: "{{ route('today.revisions') }}",
				},
				columns: [
					{ data: 'id'},
					{ data: 'document'},
					{ data: 'type'},
					{ data: 'changes'},
					{ data: 'change_by'},
					{ data: 'dateFormat'},
				],
				columnDefs: [
					{
			   			targets: 1,
			   			width: '30%'
			   		},
			   		{
			   			targets: 3,
			   			width: '40%'
			   		},
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

			let tblRequesting = $('#tblRequesting').DataTable({
				processing: true,
				serverSide: true,
				order: [[0, 'desc']],
				buttons: [
					{
						extend: 'colvis',
						text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
						className: 'btn btn-default btn-icon'
					},
				],
				ajax: {
					url: "{{ route('requesting') }}"
				},
				columns: [
					{ data: 'id'},
					{ data: 'type'},
					{ data: 'title'},
					{ data: 'description'},
					{ data: 'author'},
					{ data: 'division'},
					{ data: 'implementors'},
					{ data: 'date'}
				],
				columnDefs: [
				{
					targets: [0, 4, 5, 7],
					visible: false,
					searchable: false
				},
				{
					targets: 8,
					render:  function ( data, type, row, meta ) {
						if(row['status'] == 1 && row['isConfirm'] == 0) {
							return '<span class="text-success">Requesting</span>';
						} else if(row['status'] == 1 && row['isConfirm'] == 1) {
							return '<span class="text-primary">Approved</span>';
						} else {
							return '<span class="text-danger">Cancelled</span>';
						}
					}
				}
				],
				drawCallback: function () {
					$(this).find('tbody tr').slice(2).find('.dropdown, .btn-group').addClass('dropup');
				}
			});
			
			tableExtensions();
			
			$(document).on('click', '.btnApprove', function(e) {
				e.preventDefault();
				let id = $(this).attr('id');
				$.ajax({
					url: '{{ route('approved') }}',
					data: { id: id, _token: '{{csrf_token()}}' },
					success: function(response){
						if(response) {
							swal({
								title: "Success",
								text: "Post Successfully Approved!",
								type: "success",
								confirmButtonColor: "#00cc66"
							}, function() {
								location.reload();
							});
						}
					}
				})
			})

			$(document).on('click', '.btnCancel', function(e) {
				e.preventDefault();
				let id = $(this).attr('id');
				$.ajax({
					url: '{{ route('cancelled') }}',
					data: { id: id, _token: '{{csrf_token()}}' },
					success: function(response){
						if(response) {
							swal({
								title: "Success",
								text: "Post Successfully Cancelled!",
								type: "success",
								confirmButtonColor: "#00cc66"
							}, function() {
								tblApprovalPosts.ajax.reload();
							});
						}
					}
				})
			})

			let noOfPost = () => {
				$.ajax({
					url: '{{ route('no.process') }}',
					data: {_token: '{{csrf_token()}}' },
					success: function(response){
						$('.totalProcesses').text(response);
					}
				})
			}

			let noOfForms = () => {
				$.ajax({
					url: '{{ route('no.form') }}',
					data: {_token: '{{csrf_token()}}' },
					success: function(response){
						$('.totalForms').text(response);
					}
				})
			}

			let noOfMeetings = () => {
				$.ajax({
					url: '{{ route('no.meeting') }}',
					data: {_token: '{{csrf_token()}}' },
					success: function(response){
						$('.totalMeetings').text(response);
					}
				})
			}

			noOfPost();
			noOfForms();
			noOfMeetings();


			
		})
	</script>

@endsection