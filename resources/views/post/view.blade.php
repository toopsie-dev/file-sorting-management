@extends('layout.app')

@section('page-style')
	<style>
	   img#imgPreview {
	       max-width: 150px;
	       max-height: 150px;
	   }
	</style>
@endsection

@section('title-page')
	<h4><i class="icon-menu6 position-left"></i>Posts</h4>
@endsection

@section('page-body')
	<div class="row">
		<a href="{{ route('post.list') }}" class="button btn btn-default heading-btn"><i class="icon-arrow-left32 position-left"></i>Back</a><br/><br/>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h6 class="panel-title">View 
					@php
						$url  = $_SERVER["PHP_SELF"];
						$path = explode("/", $url); 
						$last = end($path);
						echo $last
					@endphp	
				</h6>
				{{-- <form class="form-horizontal" method="GET" >
				@csrf --}}
				<div class="heading-elements">
					<div class="multi-select-full">
						<select class="bootstrap-select" name="cboType" data-width="100%">
							<option selected hidden disabled>Nothing selected</option>
							<option value="Post">All</option>
							<option value="Process">Process</option>
							<option value="Form">Form</option>
							<option value="Meeting">Meeting</option>
						</select>
					</div>
				</div>
				{{-- </form> --}}
			</div>
			<div class="panel-body text-center">
				<table class="table table-bordered table-hovered">
					<tbody id="table">
						@foreach ($posts as $key => $post)
							@if ($key % 4 == 0)
								<tr>
								<td class="col-md-3" style="background-color: #e6ffee; cursor: pointer;" onMouseOver="this.style.backgroundColor='#eeccff'" onMouseOut="this.style.backgroundColor='#e6ffee'">
									<a href="{{ $post['revisions']->type == 'link' ? $post['revisions']->document : '../../files/' . $post['revisions']->document}}" target="{{ $post['revisions']->type == 'link' ? '_blank': 'download'}}">
										<img id="imgPreview" src="../../images/documents/{{$post['post']->image}}" /><br/>
										<span>{{$post['post']->title}}</span><br/><br/>
										<small>{{$post['stringImplementors']}}</small><br/>
										<span class="label label-default">{{$post['revisions']->type}}</span>
									</a>
								</td>
							@else
								<td class="col-md-3" style="background-color: #e6ffee; cursor: pointer;" onMouseOver="this.style.backgroundColor='#eeccff'" onMouseOut="this.style.backgroundColor='#e6ffee'">
									<a href="{{ $post['revisions']->type == 'link' ? $post['revisions']->document : '../../files/' . $post['revisions']->document}}" target="{{ $post['revisions']->type == 'link' ? '_blank': 'download'}}">
										<img id="imgPreview" src="../../images/documents/{{$post['post']->image}}" /><br/>
										<span>{{$post['post']->title}}</span><br/><br/>
										<small>{{$post['stringImplementors']}}</small><br/>
										<span class="label label-default">{{$post['revisions']->type}}</span>
									</a>
								</td>
							@endif
						@endforeach
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

			$(document).on('change', '[name=cboType]', function() {
				let type = $(this).val();
				window.location = '../../posts/view/' + type;
			})

		})
	</script>

@endsection