
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Gleentdocs</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">

	<link href="{{ asset('css/icons/icomoon/styles.css') }}" rel="stylesheet">
	<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('css/core.css') }}" rel="stylesheet">
	<link href="{{ asset('css/components.css') }}" rel="stylesheet">
	<link href="{{ asset('css/colors.css') }}" rel="stylesheet">
	<link href="{{ asset('css/modify.css') }}" rel="stylesheet">

	<script type="text/javascript" src="{{ asset('js/plugins/loaders/pace.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/core/libraries/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/core/libraries/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/plugins/loaders/blockui.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('js/plugins/visualization/d3/d3.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/plugins/forms/styling/switchery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/plugins/forms/styling/uniform.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/plugins/ui/moment/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/plugins/pickers/daterangepicker.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/plugins/visualization/d3/d3.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/plugins/ui/nicescroll.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/pages/datatables_advanced.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/plugins/tables/datatables/datatables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/plugins/forms/selects/select2.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('js/plugins/notifications/bootbox.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/plugins/notifications/sweet_alert.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/pages/components_modals.js') }}"></script>

	<script type="text/javascript" src="{{ asset('js/plugins/forms/selects/bootstrap_select.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/pages/form_bootstrap_select.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/pages/form_multiselect.js') }}"></script>

	<script type="text/javascript" src="{{ asset('js/plugins/uploaders/fileinput.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/pages/uploader_bootstrap.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/pages/form_inputs.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/plugins/tables/datatables/extensions/buttons.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('js/plugins/tables/footable/footable.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/pages/table_responsive.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/pages/datatables_extension_buttons_print.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/pages/datatables_extension_select.js') }}"></script>
	
	<script type="text/javascript" src="{{ asset('js/plugins/tables/datatables/extensions/select.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/pages/datatables_extension_buttons_html5.js') }}"></script>

	<script type="text/javascript" src="{{ asset('js/plugins/tables/datatables/extensions/jszip/jszip.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('js/pages/datatables_extension_buttons_init.js') }}"></script>


	<script type="text/javascript" src="{{ asset('validation/jquery.validate.js') }}"></script>
	<script type="text/javascript" src="{{ asset('validation/additional-methods.js') }}"></script>

	<script type="text/javascript" src="{{ asset('js/validation.js') }}"></script>


	{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script> --}}

	@section('page-style')
	@show


</head>

<body class="navbar-top">

	<!-- Main navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.html"><img src="{{ asset('images/Gleent-Logo-Dark-compressed.png') }}" id="navbar-logo" alt=""></a>

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle user-profile" data-toggle="dropdown">
						<span>Hello {{ $info['info']['first_name'] }}</span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="{{ route('profile') }}"><i class="icon-user-plus"></i> My profile</a></li>
						<li class="divider"></li>
						<li><a href="{{ route('password') }}"><i class="icon-cog5"></i> Account settings</a></li>
						<li><a href="{{ route('logout') }}"><i class="icon-switch2"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main sidebar-fixed">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content justify-content-center">
							<div class="text-center mt-20">
								<img src="{{ $info['info']['img'] == null ? asset('images/profile/default.png') : asset('images/profile/'. $info['info']['img']) }}" class="img-circle avatar" alt="">
								<h5 class="media-heading text-semibold mt-20">{{ $info['info']['first_name'] . ' ' . $info['info']['last_name'] }}</h5>
								<small class="text-primary display-inline-block">{{'(' . $info['info']['access_level'] .')'}}</small>
								<small class="media-heading text-semibold"> {{ $info['info']['division']['name'] }} </small>
								@if ($info['info']['access_level'] == 'Employee')
									<small class="media-heading text-semibold"> {{ $info['info']['departments'] }} </small>
								@endif
							</div>
						</div>
					</div>
					<!-- /user menu -->

					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">

								<!-- Main -->
								<li class="navigation-header"><span>General</span> <i class="icon-menu" title="Main pages"></i></li>
								@if ($info['info']['access_level'] !== 'Intern')
									<li id="sbDashboard"><a href="{{ route('dashboard') }}"><i class="icon-home2"></i> <span>Dashboard</span></a></li>
								@endif
								
								@if ($info['info']['access_level'] === 'Admin')
									<li id="sbUsers"><a href="{{ route('users.active') }}"><i class="icon-users"></i> <span>Users</span></a></li>
								@endif

								@if ($info['info']['access_level'] !== 'Intern')
									<li id="sbPost">
										<a href="#"><i class="icon-menu6"></i> <span>Post</span></a>
										<ul>
											<li><a href="{{ route('post.new') }}"><span>New Post</span></a></li>
											@if ($info['info']['access_level'] === 'Admin')
												<li><a href="{{ route('post.list') }}"><span>View Posts</span></a></li>
											@endif
										</ul>
									</li>
								@endif

								<li id="sbProcess"><a href="{{ route('process') }}"><i class="icon-clipboard2"></i> <span>Processes</span></a></li>
								<li id="sbForm"><a href="{{ route('form') }}"><i class="icon-notebook"></i> <span>Forms</span></a></li>
								<li id="sbMeeting"><a href="{{ route('meeting') }}"><i class="icon-menu6"></i> <span>Meeting</span></a></li>

								@if ($info['info']['access_level'] === 'Admin')
									<li id="sbDivision"><a href="../divisions"><i class="icon-office"></i> <span>Departments</span></a></li>
								@endif
							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Page header -->
				{{-- <div class="page-header page-header-default">
					<div class="page-header-content">
						<div class="page-title">
							@section('title-page')
							@show
						</div>
					</div> --}}
					{{-- <div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="index.html">Home</a></li>
							<li class="active">Dashboard</li>
						</ul>
					</div> --}}
				{{-- </div> --}}
				<!-- /page header -->

				<!-- Content area -->
				<div class="content">
					@section('page-body')
					@show
				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

	@section('page-script')



	@show

</body>
</html>
