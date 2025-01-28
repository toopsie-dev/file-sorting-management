<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\RevisionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

// LOGOUT

Route::get('/', function () {
	if(session()->has('userId')) {
		session()->forget('userId');
		return redirect('/');
	}
	return view('login');
})->name('logout');

// DIVISIONS

Route::get('divisions', [DivisionController::class, 'index']);

Route::get('divisions/list', [DivisionController::class, 'getDivisions']);

Route::post('divisions', [DivisionController::class, 'store']);

Route::put('divisions/{division}', [DivisionController::class, 'update']);

Route::delete('divisions/{division}', [DivisionController::class, 'destroy']);

Route::get('divisions/{division}', [DivisionController::class, 'showDepartment']);

// DEPARTMENTS

Route::get('departments/list', [DepartmentController::class, 'getDepartments']);

Route::post('departments', [DepartmentController::class, 'store']);

Route::put('departments/{department}', [DepartmentController::class, 'update']);

Route::delete('departments/{division}', [DepartmentController::class, 'destroy']);


// POSTS

Route::get('posts/new', [PostController::class, 'index'])->name('post.new');

Route::post('posts', [PostController::class, 'store']);

Route::get('posts', [PostController::class, 'allPosts'])->name('post.list');

Route::get('posts/{post}', [PostController::class, 'getPostDetails']);

Route::put('posts/{post}', [PostController::class, 'update']);

Route::delete('posts/{post}', [PostController::class, 'destroy']);

Route::get('posts/view/Post', [PostController::class, 'viewPosts'])->name('post.view');

Route::get('posts/remove/Post', [PostController::class, 'postsRemove'])->name('post.remove');

Route::get('posts/remove/retrieve', [PostController::class, 'postsRetrieve'])->name('post.retrieve');

Route::get('posts/view/{type}', [PostController::class, 'filterType']);

Route::get('posts/approval/list', [PostController::class, 'postApproval'])->name('approval.post');

Route::get('approved/post', [PostController::class, 'approved'])->name('approved');

Route::get('cancelled/post', [PostController::class, 'cancelled'])->name('cancelled');

Route::get('requesting/post', [PostController::class, 'requesting'])->name('requesting');

Route::get('number/processes', [PostController::class, 'noOfPost'])->name('no.process');

Route::get('number/forms', [PostController::class, 'noOfForm'])->name('no.form');

Route::get('number/meetings', [PostController::class, 'noOfMeeting'])->name('no.meeting');

// REVISIONS

Route::get('posts/{id}/revision', [RevisionController::class, 'index'])->name('post.revisions');

Route::get('posts/revision/list', [RevisionController::class, 'getRevisions'])->name('list.revisions');

Route::post('posts/{id}/revision', [RevisionController::class, 'addRevision']);

Route::get('today/revision', [RevisionController::class, 'todayRevisions'])->name('today.revisions');

// USERS

Route::get('users', [UserController::class, 'getAllActiveUsers'])->name('users.active');

Route::get('users/divisions', [DivisionController::class, 'getDivisions'])->name('users.division');

Route::get('users/departments', [DepartmentController::class, 'getDivisionDepartments'])->name('users.department');

Route::post('users', [UserController::class, 'store']);

Route::delete('users/{user}', [UserController::class, 'destroy']);

Route::get('users/getDetails', [UserController::class, 'getUserDetails'])->name('user.details');

Route::put('users', [UserController::class, 'update']);

Route::get('users/remove', [UserController::class, 'getAllInactiveUsers'])->name('users.inactive');

Route::get('users/retrieve', [UserController::class, 'retriveUser'])->name('users.retrieve');

Route::get('users/reset', [UserController::class, 'resetPassword'])->name('users.reset');

Route::get('profile', [UserController::class, 'getProfile'])->name('profile');

Route::post('upload', [UserController::class, 'uploadImage'])->name('upload');

Route::get('password', [UserController::class, 'viewPassword'])->name('password');

Route::get('password/change', [UserController::class, 'changePassword'])->name('change.password');

// ACCOUNT

Route::get('account', [AccountController::class, 'validateCredentials'])->name('credentials');

Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');

Route::get('session', [UserController::class, 'getCurrentUser'])->name('session');

// PROCESS

Route::get('process', [ProcessController::class, 'index'])->name('process');

Route::get('process/list', [ProcessController::class, 'allProcess'])->name('process.list');

// FORM

Route::get('form', [FormController::class, 'index'])->name('form');

Route::get('form/list', [FormController::class, 'allForms'])->name('form.list');

// FORM

Route::get('meeting', [MeetingController::class, 'index'])->name('meeting');

Route::get('meeting/list', [MeetingController::class, 'allMeetings'])->name('meeting.list');





