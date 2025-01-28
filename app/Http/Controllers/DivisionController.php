<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UserController;
use App\Models\Division;
use App\Repositories\DepartmentRepository;
use App\Repositories\DivisionRepository;
use DataTables;
use Illuminate\Http\Request;

class DivisionController extends Controller
{

    public function index(UserController $user, Request $request) {

        $info = $user->getCurrentUser($request);
        return view('division.index', compact('info'));
    }

    public function getDivisions(DivisionRepository $division) {

        echo json_encode($division->fetchAllDivision());
    }

    public function store(DivisionRepository $division, Request $request) {

        echo $division->createDivision($request->division);
    }

    public function update(DivisionRepository $division, Request $request, $id) {
        
        echo $division->updateDivision($request->editDivision, $id);
    }

    public function destroy(DivisionRepository $division, $id) {
       
        echo $division->removeDivision($id);
    }

    public function showDepartment(DepartmentRepository $department, $id) {

        echo json_encode($department->fetchDepartments($id));
    }

}
