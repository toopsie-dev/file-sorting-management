<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
use App\Models\Department;
use App\Models\Division;
use App\Models\Implementor;
use App\Models\Post;
use App\Models\UserDepartment;
use DataTables;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public $form = 0;

    public function index(UserController $user, Request $request) {

        $info = $user->getCurrentUser($request);
        return view('form.index', compact('info'));
    }

    public function allForms(UserController $user, Request $request) {
        
        $info = $user->getCurrentUser($request);

        if($request->ajax()) {
            $data = Post::where('status', 1)->where('isConfirm', 1)->where('type', 'Form')->get();
            for ($i = 0; $i < count($data) ; $i++) { 
                $string = '';
                $implementors = Implementor::where('post_id', $data[$i]['id'])->get();
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

            if($info['info']['access_level'] === 'Intern') {
                $container = array();
                for ($i = 0; $i < count($data) ; $i++) {
                    if($data[$i]['division'] === 'Overall') {
                        array_push($container, $data[$i]);
                    }
                }
                return DataTables::of($container)->make(true);
            } else if ($info['info']['access_level'] === 'Employee') {
               $implementor = array();
                    for($i = 0; $i < count($info['department']); $i++) {
                        array_push($implementor, $info['department'][$i]['department_id']);
                    }
                $postDepartment = Implementor::whereIn('dep_id', $implementor)->get();
                $depIds = array();
                    for($i = 0; $i < count($postDepartment); $i++) {
                        array_push($depIds, $postDepartment[$i]['post_id']);
                    }
                $ids = array_values(array_unique($depIds));

                $container = array();

                for($y = 0; $y < count($ids); $y++) {
                    for ($i = 0; $i < count($data) ; $i++) {
                        if($data[$i]['id'] === $ids[$y]) {
                            array_push($container, $data[$i]);
                        }
                    }
                }

                for ($i = 0; $i < count($data) ; $i++) {
                    if($data[$i]['division'] === 'Overall') {
                        array_push($container, $data[$i]);
                    }
                }
                $this->form = count($container);
                return DataTables::of($container)->make(true);
            } else {
                $this->form = count($data);
                return DataTables::of($data)->make(true);
            }
           
        }

        return view('form.index', compact('info'));
    }

    public function getForm() {
        return $this->form;
    }
}
