<?php

namespace App\Repositories;

use App\Models\Department;
use Faker\Provider\DateTime;
use Illuminate\Database\Eloquent\Model;

class DepartmentRepository
{
   
	public function createDepartment($request) {
     	Department::insert(array('name' => $request['department'], 'division_id' => $request['id'], 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")));
     	return true;
   }

   public function updateDepartment($editName, $id) {
      Department::where( 'id', $id )->update(array( 'name'=>$editName, 'updated_at' => date('Y-m-d H:i:s') ));
      return true;
   }

   public function removeDepartment($id) {
      Department::where( 'id', $id )->delete();
      return true;
   }

   public function fetchAllDepartments() {
     return Department::get();
   }

   public function fetchDepartments($id) {
     return Department::where( 'division_id', $id )->get();
   }

    


}
