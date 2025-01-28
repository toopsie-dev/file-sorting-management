<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Division;
use App\Repositories\DepartmentRepository;
use DataTables;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function getDivisionDepartments(Request $request) {
        return Department::where('division_id', $request['id'])->get();
    }
   
    public function getDepartments(DepartmentRepository $department) {
        echo json_encode($department->fetchAllDepartments());
    }

    public function store(DepartmentRepository $department, Request $request) {
        echo $department->createDepartment($request);
    }

    public function update(DepartmentRepository $department, Request $request, $id) {
        echo $department->updateDepartment($request->editDepartment, $id);
    }
    
    public function destroy(DepartmentRepository $department, $id) {
        echo $department->removeDepartment($id);
    }
}
