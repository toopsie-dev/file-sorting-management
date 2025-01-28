<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Implementor;
use App\Models\Post;
use App\Models\Revision;
use App\Repositories\DepartmentRepository;
use App\Repositories\DivisionRepository;
use App\Repositories\RevisionRepository;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class RevisionController extends Controller
{
    
    public function index(RevisionRepository $revision, $id, DivisionRepository $division, DepartmentRepository $department, UserController $user, Request $request) {
        $info = $user->getCurrentUser($request);
        $revisions = $revision->retrievePost($id);
        $departments = $division->fetchDivisionDepartment($department);
        $post = Post::find($id);
        $post['implementors'] = Implementor::where('post_id', $id)->get(['dep_id'])->map(function ($item){
            return $item->dep_id;
        });
        $post['count'] = Revision::where('post_id', $id)->count();
        return view('post.revision',compact('revisions', 'departments', 'post', 'info'));
    }

    public function addRevision(PostController $post, RevisionRepository $revision, UserController $user, $id, Request $request) {

        $data = array();
        $info = $user->getCurrentUser($request);
        $image = $post->validateFile($request, 'image', false);

        $data['image'] = $image == null || $image == '' ? '' : $image;
        $data['title'] = $request['txtEditTitle'];
        $data['changes'] = $request['txtRevision'];
        $data['revisionId'] = $request['txtRevisionId'];
        $data['division'] = $request['cboEditDivision'];
        $data['departments'] = $request['implementors'];
        if(empty($request['txtLink'])) {
            $data['type'] = 'file';
            $data['document'] = $post->validateFile($request, 'file', true);
        } else {
            $data['type'] = 'link';
            $data['document'] = $request['txtLink'];
        }
        $data['change_by'] = $info['info']['first_name'] . ' ' . $info['info']['last_name'];
        echo $revision->addRevision($id, $data);
    }

    public function getRevisions(Request $request) {
        if($request->ajax()) {
            $data = Revision::where('post_id', $request['id'])->orderBy('id', 'DESC')->get();
            for ($i = 0; $i < count($data) ; $i++) { 
               $data[$i]['dateFormat'] = date('d M Y', strtotime($data[$i]['date']));
            }
            return DataTables::of($data)->make(true);
        }
        return view('post.list', compact('info'));
    }

    public function todayRevisions(Request $request) {
        if($request->ajax()) {
            $data = Revision::where('changes', '<>', '')->whereDate('date', Carbon::now())->orderBy('id', 'DESC')->get();
            for ($i = 0; $i < count($data) ; $i++) { 
               $data[$i]['dateFormat'] = date('d M Y', strtotime($data[$i]['date']));
            }
            return DataTables::of($data)->make(true);
        }
        return view('dashboard.index', compact('info'));
    }

    
}
