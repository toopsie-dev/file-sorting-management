<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
use App\Models\Department;
use App\Models\Division;
use App\Models\Post;
use App\Models\implementor;
use App\Repositories\DepartmentRepository;
use App\Repositories\DivisionRepository;
use App\Repositories\PostRepository;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PostController extends Controller
{
    public function index(DivisionRepository $division, DepartmentRepository $department, UserController $user, Request $request) {
        $info = $user->getCurrentUser($request);
        // $departments = $division->fetchDivisionDepartment($department);
        // return view('post.index', compact('departments', 'info'));
        return view('post.index', compact('info'));
    }

    public function upload($request, $isFile){

        if($isFile) {
            $type = 'file';
            $destination = 'files/';
            $validextensions = array("xlsx","xls","csv","pdf","txt","docx");
            $fileName = $request->file($type)->getClientOriginalName();
        } else {
            $type = 'image';
            $destination = 'images/documents';
            $validextensions = array("jpeg","jpg","png");
            $fileName = $request->file($type)->getClientOriginalName();
        }

        if($request->hasFile($type)) {
            $destinationPath = $destination;
            $extension = $request->file($type)->getClientOriginalExtension();
            if(in_array(strtolower($extension), $validextensions)){
                $request->file($type)->move($destinationPath, (date('mdyHi') . $fileName));
                return date('mdyHi') . $fileName;
            }
        }
    }

    public function store(PostRepository $post, UserController $user, Request $request){

        $data = array();
        $image = $this->validateFile($request, 'image', false);
        $file = $this->validateFile($request, 'file', true);
        $data['image'] = $image == null || $image == '' ? 'default.jpg' : $image;
        $data['docType'] = $file == null || $file == '' ? 'link' : 'file';
        $data['document'] = $file == null || $file == '' ? $request['txtLink'] : $file;
        $data['title'] = $request['txtTitle'];
        $data['description'] = $request['txtDescription'];
        $data['type'] = $request['cboPostType'];
        $data['division'] = $request['cboDivision'];
        $data['implementors'] = $request['implementors'];
        $info = $user->getCurrentUser($request);
        $data['author'] = $info['info']['first_name'] . ' ' . $info['info']['last_name'];
        echo $post->createPost($data);  
    }

    public function validateFile($request, $type, $isImage) {

        $file = '';
        if($request->file($type) != null || $request->file($type) != "") {
            $file = $this->upload($request, $isImage);
        }
        return $file;
    }

    public function allPosts(PostRepository $post, UserController $user, Request $request) {

        $info = $user->getCurrentUser($request);
        if($request->ajax()) {
            $data = Post::where('status', 1)->where('isConfirm', 1)->get();
            for ($i = 0; $i < count($data) ; $i++) { 
                $string = '';
                $implementors = implementor::where('post_id', $data[$i]['id'])->get();
                for ($y = 0; $y < count($implementors) ; $y++) {
                    $string .= Department::find($implementors[$y]['dep_id'])->name . ', ';
                    if($y == count($implementors) - 1) {
                       $string = substr($string, 0, -2);
                    }
                }
                $division = Division::select('name')->where('id', $data[$i]['division_id'])->first();
                $data[$i]['division'] = $division['name'];
                $data[$i]['implementors'] = $string;
                $data[$i]['date'] = date('d M Y', strtotime($data[$i]['created_at']));
            }
            return DataTables::of($data)->make(true);
        }
        return view('post.list', compact('info'));
    }

    public function postsRemove(PostRepository $post, UserController $user, Request $request) {

        $info = $user->getCurrentUser($request);
        if($request->ajax()) {
            $data = Post::where('status', 0)->where('isConfirm', 1)->get();
            for ($i = 0; $i < count($data) ; $i++) { 
                $string = '';
                $implementors = implementor::where('post_id', $data[$i]['id'])->get();
                for ($y = 0; $y < count($implementors) ; $y++) {
                    $string .= Department::find($implementors[$y]['dep_id'])->name . ', ';
                    if($y == count($implementors) - 1) {
                       $string = substr($string, 0, -2);
                    }
                }
                $division = Division::select('name')->where('id', $data[$i]['division_id'])->first();
                $data[$i]['division'] = $division['name'];
                $data[$i]['implementors'] = $string;
                $data[$i]['date'] = date('d M Y', strtotime($data[$i]['updated_at']));
            }
            return DataTables::of($data)->make(true);
        }
        return view('post.remove', compact('info'));
    }

    public function postsRetrieve(Request $request) {
        return  Post::where('id', $request['id'])->update(
                    array( 'status' => 1, 'updated_at' => date('Y-m-d H:i:s')
                ));
    }

    public function getPostDetails($id, DivisionRepository $division, DepartmentRepository $department, UserController $user, Request $request) {

        $info = $user->getCurrentUser($request);
        $departments = $division->fetchDivisionDepartment($department);
        $post = Post::find($id);
        $post['implementors'] = Implementor::where('post_id', $id)->get(['dep_id'])->map(function ($item){
            return $item->dep_id;
        });
        return view('post.edit',compact('post','departments', 'info'));
    }

    public function update(PostRepository $post, Request $request, $id) {

        $data = array();
        $image = $this->validateFile($request, 'image', false);
        $data['image'] = $image;
        $data['title'] = $request['txtEditTitle'];
        $data['description'] = $request['txtEditDescription'];
        $data['implementors'] = $request['implementors'];

        echo $post->editPost($data, $id);
    }

    public function destroy(PostRepository $post, $id){

        echo $post->removePost($id);
    }

    public function viewPosts(PostRepository $post, UserController $user, Request $request) {
        $info = $user->getCurrentUser($request);
        $posts = $post->fetchAllPosts();
        return view('post.view',compact('posts', 'info'));
    }

    public function filterType(PostRepository $post, UserController $user, Request $request, $type) {
        $info = $user->getCurrentUser($request);
        $posts = $post->filterType($type);
        return view('post.view',compact('posts' , 'info'));
    }

    public function postApproval(PostRepository $post, UserController $user, Request $request) {

        $info = $user->getCurrentUser($request);
        if($request->ajax()) {
            $data = Post::where('status', 1)->where('isConfirm', 0)->get();
            for ($i = 0; $i < count($data) ; $i++) { 
                $string = '';
                $implementors = implementor::where('post_id', $data[$i]['id'])->get();
                for ($y = 0; $y < count($implementors) ; $y++) {
                    $string .= Department::find($implementors[$y]['dep_id'])->name . ', ';
                    if($y == count($implementors) - 1) {
                       $string = substr($string, 0, -2);
                    }
                }
                $division = Division::select('name')->where('id', $data[$i]['division_id'])->first();
                $data[$i]['division'] = $division['name'];
                $data[$i]['implementors'] = $string;
                $data[$i]['date'] = date('d M Y', strtotime($data[$i]['created_at']));
            }
            return DataTables::of($data)->make(true);
        }
       return view('dashboard.index', compact('info'));
    }

    public function approved(Request $request) {

       return Post::where('id', $request['id'])->update(
                    array( 'isConfirm' => 1, 'updated_at' => date('Y-m-d H:i:s')
                ));
    }

    public function cancelled(Request $request) {

       return Post::where('id', $request['id'])->update(
                    array( 'status' => 0, 'updated_at' => date('Y-m-d H:i:s')
                ));
    }

    public function requesting(UserController $user, Request $request) {

        $info = $user->getCurrentUser($request);
        if($request->ajax()) {
            $data = Post::whereDate('created_at', Carbon::now())->where('author', $info['info']['first_name'] . ' ' . $info['info']['last_name'])->get();
            for ($i = 0; $i < count($data) ; $i++) { 
                $string = '';
                $implementors = implementor::where('post_id', $data[$i]['id'])->get();
                for ($y = 0; $y < count($implementors) ; $y++) {
                    $string .= Department::find($implementors[$y]['dep_id'])->name . ', ';
                    if($y == count($implementors) - 1) {
                       $string = substr($string, 0, -2);
                    }
                }
                $division = Division::select('name')->where('id', $data[$i]['division_id'])->first();
                $data[$i]['division'] = $division['name'];
                $data[$i]['implementors'] = $string;
                $data[$i]['date'] = date('d M Y', strtotime($data[$i]['created_at']));
            }
            return DataTables::of($data)->make(true);
        }
       return view('dashboard.index', compact('info'));
    }

    public function noOfPost(ProcessController $process, UserController $user, Request $request) {

        $info = $user->getCurrentUser($request);
        $process->allProcess($user, $request);
        return $process->getProcess();
    }

    public function noOfForm(FormController $form, UserController $user, Request $request) {

        $info = $user->getCurrentUser($request);
        $form->allForms($user, $request);
        return $form->getForm();
    }
    
    public function noOfMeeting(MeetingController $meeting, UserController $user, Request $request) {

        $info = $user->getCurrentUser($request);
        $meeting->allMeetings($user, $request);
        return $meeting->getMeeting();
    }
}
