@extends('layout.app')

@section('page-style')

@endsection

@section('title-page')
	<h4><i class="icon-menu6 position-left"></i>Posts</h4>
@endsection

@section('page-body')
	<div class="row">
		<a href="{{ route('post.list') }}" class="button btn btn-default heading-btn"><i class="icon-arrow-left32 position-left"></i>Back</a><br/><br/>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h6 class="panel-title">Remove Posts</h6>
			</div>
			<div class="panel-body">
				<table class="table" id="tblRemovePosts">
					<thead>
						<tr>
							<th>Post Id</th>
							<th>Type</th>
							<th>Title</th>
							<th>Description</th>
							<th>Author</th>
							<th>Division</th>
							<th>Implementors</th>
							<th>Date Removed</th>
							<th></th>
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
			$('#sbPost').addClass('active');

			let tableExtensions = () => {
				$('.dataTables_filter input[type=search]').attr('placeholder','Type to filter...');
				$('.dataTables_length select').select2({
					minimumResultsForSearch: Infinity,
					width: 'auto'
				});
			}

			let tblRemovePosts = $('#tblRemovePosts').DataTable({
				processing: true,
				serverSide: true,
				order: [[0, 'desc']],
				autoWidth: false,
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
					url: "{{ route('post.remove') }}"
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
					targets: [0, 4],
					visible: false,
					searchable: false
				},
				{
					targets: 3,
					visible: false,
					searchable: false,
				},
				{
					targets: 8,
					render:  function ( data, type, row, meta ) {
						return `<a href="" id="${row['id']}" class="button btn-xs btn btn-warning heading-btn btnRetrieve"><i class="icon-redo position-left"></i>Retrieve</a>`;
					}
				}
				],
				drawCallback: function () {
					$(this).find('tbody tr').slice(2).find('.dropdown, .btn-group').addClass('dropup');
				}
			});

			tableExtensions();

			$(document).on('click', '.btnRetrieve', function(e) {
				e.preventDefault();
				let id = $(this).attr('id');
				swal({
					title: "Are you sure?",
					text: "This post will be retrived!",
					type: "info",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, retrieve it!",
					closeOnConfirm: false,
					html: false
				}, function() {
					$.ajax({
						url: "{{ route('post.retrieve') }}",
						data: { id: id },
						success: function(response){
							if(response) {
								swal({
									title: "Success",
									text: "Post Successfully retrieved!",
									type: "success",
									confirmButtonColor: "#00cc66"
								}, function() {
									window.location = "{{ route('post.list') }}";
								});
							}
						}
					})

				});
			})

		})
	</script>

@endsection