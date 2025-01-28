<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DivisionController;
use App\Models\Account;
use App\Models\Department;
use App\Models\Division;
use App\Models\User;
use App\Models\UserDepartment;
use App\Repositories\DepartmentRepository;
use App\Repositories\DivisionRepository;
use App\Repositories\UserRepository;
use DataTables;
use Illuminate\Http\Request;

class UserController extends Controller
{
   
    public function store(Request $request){

        $userId = User::insertGetId(
          array('first_name' => $request['txtFirstName'],
            'last_name' => $request['txtLastName'],
            'access_level' => $request['cboAccessLevel'],
            'division_id' => $request['cboDivision'],
            'status' => 1,
            'img' => null,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
          )
        );

        if(!empty($userId)) {
            if(!empty($request['departments'])) {
                $departments = explode(',', $request['departments']);
                foreach($departments as $department) {
                    UserDepartment::insert(
                        array( 'user_id' => $userId,
                          'department_id' => $department, )
                    );
                }
            }
           
            Account::insert(
                array( 'email' => $request['txtEmail'],
                  'password' => password_hash($request['txtDefaultPassword'], PASSWORD_DEFAULT),
                  'user_id' =>  $userId )
            );

            return true;
        }
    }

    public function destroy($id){
        User::where('id', $id )->update(
            array( 'status' => 0,
           )
        );
    }

    public function getUserDetails(Request $request){
       $data = array();
       $data['info'] = User::find($request['id']);
       $data['account'] = Account::select('email')->where('user_id', $request['id'])->first();
       $data['department'] = UserDepartment::select('department_id')->where('user_id', $request['id'])->get();
       return $data;
    }

    public function getAllActiveUsers(Request $request) {

        $info = $this->getCurrentUser($request);
        if($request->ajax()) {
            $data = User::where('status', 1)->get();
            for ($i = 0; $i < count($data) ; $i++) { 
                $string = '';
                $departments = UserDepartment::where('user_id', $data[$i]['id'])->get();
                for ($y = 0; $y < count($departments) ; $y++) {
                    $string .= Department::find($departments[$y]['department_id'])->name . ', ';
                    if($y == count($departments) - 1) {
                       $string = substr($string, 0, -2);
                    }
                }
                $division = Division::select('name')->where('id', $data[$i]['division_id'])->first();
                $data[$i]['division'] = $division['name'];
                $data[$i]['departments'] = $string;
                $data[$i]['date'] = date('d M Y', strtotime($data[$i]['created_at']));
            }
            return DataTables::of($data)->make(true);
        }
        return view('user.index', compact('info'));
    }

    public function getAllInactiveUsers(Request $request) {

        $info = $this->getCurrentUser($request);
        if($request->ajax()) {
            $data = User::where('status', 0)->get();
            for ($i = 0; $i < count($data) ; $i++) { 
                $string = '';
                $departments = UserDepartment::where('user_id', $data[$i]['id'])->get();
                for ($y = 0; $y < count($departments) ; $y++) {
                    $string .= Department::find($departments[$y]['department_id'])->name . ', ';
                    if($y == count($departments) - 1) {
                       $string = substr($string, 0, -2);
                    }
                }
                $data[$i]['departments'] = $string;
                $data[$i]['date'] = date('d M Y', strtotime($data[$i]['created_at']));
            }
            return DataTables::of($data)->make(true);
        }
        return view('user.remove', compact('info'));
    }

    public function update(Request $request){
        User::where('id', $request['txtEditId'])->update(
            array( 'access_level' => $request['cboEditAccessLevel'],
                'first_name' => $request['txtEditFirstName'],
                'last_name' => $request['txtEditLastName'],
            )
        );

        Account::where('user_id', $request['txtEditId'])->update(
            array( 'email' => $request['txtEditEmail'],
            )
        );

        UserDepartment::where('user_id', $request['txtEditId'])->delete();

        $departments = explode(',', $request['departments']);
        foreach($departments as $department) {
            UserDepartment::insert(
            array( 'user_id' => $request['txtEditId'],
              'department_id' => $department )
            );
        }

        return true;
    }

    public function retriveUser(Request $request) {
        User::where('id', $request['id'] )->update(
            array( 'status' => 1,
           )
        );
    }

    public function resetPassword(Request $request) {

        Account::where('user_id', $request['id'])->update(
            array( 'password' => password_hash('secret!@#', PASSWORD_DEFAULT),
            )
        );

        return 'secret!@#';
    }

    public function getSession(Request $request) {
        if($request->session()->has('userId')) {
            return $request->session()->get('userId');
        } else {
            return 'Session not exist';
        }
    }

    public function getCurrentUser(Request $request) {
        $string = '';
        $userInfo = array();
        $userInfo['info'] = User::find($this->getSession($request));
        $userInfo['info']['division'] = Division::select('name')->where('id', $userInfo['info']['division_id'])->first();
        $userInfo['department'] = UserDepartment::where('user_id', $this->getSession($request))->get();
        $departments = $userInfo['department'];
            for ($y = 0; $y < count($departments) ; $y++) {
                $string .= Department::find($departments[$y]['department_id'])->name . ' / ';
                if($y == count($departments) - 1) {
                 $string = substr($string, 0, -2);
             }
         }
        $userInfo['info']['email'] = Account::select('email')->find( $userInfo['info']['id']);
        $userInfo['info']['departments'] = $string;
        return $userInfo;
    }

    public function dashboard(Request $request) {
        $info = $this->getCurrentUser($request);
        if($info['info']['access_level'] != 'Intern') {
            return view('dashboard.index', compact('info'));
        } else {
            return view('process.index', compact('info'));
        }
        
    }

    public function getProfile(Request $request) {
        $info = $this->getCurrentUser($request);
        return view('user.profile', compact('info'));
    }

    public function uploadImage(Request $request) {
        $info = $this->getCurrentUser($request);
        $destinationPath = 'images/profile';
        $fileName = $request->file('image')->getClientOriginalName();
        $extension = $request->file('image')->getClientOriginalExtension();
        if(in_array(strtolower($extension), array("jpeg","jpg","png"))){
            $request->file('image')->move($destinationPath, (date('mdyHi') . $fileName));
        }

        return User::where('id', $info['info']['id'] )->update(
            array( 'img' => date('mdyHi') . $fileName,
           )
        );
    }

    public function viewPassword(Request $request) {
        $info = $this->getCurrentUser($request);
        return view('user.password', compact('info'));
    }

    public function changePassword(Request $request) {
        $info = $this->getCurrentUser($request);

        $result = Account::select('password')->where('id', $info['info']['id'])->first();

        if(password_verify($request['old'], $result['password'])) {
            return Account::where('id', $info['info']['id'] )->update(
                array(
                    'password' => password_hash($request['new'], PASSWORD_DEFAULT),
                )
            );
        } else {
            return false;
        }
       
    }


  
}
