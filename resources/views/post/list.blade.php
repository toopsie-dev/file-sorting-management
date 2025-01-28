@extends('layout.app')

@section('page-style')

@endsection

@section('title-page')
	<h4><i class="icon-menu6 position-left"></i>Posts</h4>
@endsection

@section('page-body')
	<div class="row">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h6 class="panel-title">All Posts</h6>
				<div class="heading-elements">
					<a href="{{ route('post.view') }}" class="button btn btn-primary">View Posts</a>
					<a href="{{ route('post.remove') }}" class="button btn btn-danger">Remove</a>
				</div>
			</div>
			<div class="panel-body">
				<table class="table" id="tblPosts">
					<thead>
						<tr>
							<th>Post Id</th>
							<th>Type</th>
							<th>Title</th>
							<th>Description</th>
							<th>Author</th>
							<th>Division</th>
							<th>Implementors</th>
							<th>Date Created</th>
							<th style="width: 12%;">Actions</th>
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

			let tblPosts = $('#tblPosts').DataTable({
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
					url: "{{ route('post.list') }}"
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
						return `
						@if ($info['info']['access_level'] !== 'Intern')
							@if ($info['info']['access_level'] === 'Admin')
								<button type="button" id="${row['id']}" class="btn bg-danger-400 btn-icon btnDeletePost btn-xs display-inline-block"><i class="icon-trash" style="color: white"></i></button>
							@endif
						@endif
						<a href="posts/${row['id']}/revision" class="button btn btn-icon btn-primary btn-xs display-inline-block"><i class="icon-file-text2" style="color: white"></i></a>`;
					}
				}
				],
				drawCallback: function () {
					$(this).find('tbody tr').slice(2).find('.dropdown, .btn-group').addClass('dropup');
				}
			});

			tableExtensions();

			$(document).on('click', '.btnDeletePost', function() {
				let id = $(this).attr('id');
				swal({
					title: "Are you sure?",
					text: "This post will be removed!",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, remove it!",
					closeOnConfirm: false,
					html: false
				}, function() {
					$.ajax({
						url: '../posts/' + id,
						type: 'DELETE',
						data: { _token: '{{csrf_token()}}' },
						success: function(response){
							if(response) {
								swal({
									title: "Success",
									text: "Post Successfully removed!",
									type: "success",
									confirmButtonColor: "#00cc66"
								}, function() {
									location.reload();
								});
							}
						}
					})

				});
			})

		})
	</script>

@endsection