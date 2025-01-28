<?php

namespace App\Repositories;

use App\Models\Division;
use Faker\Provider\DateTime;
use Illuminate\Database\Eloquent\Model;

class DivisionRepository
{
   
    public function fetchAllDivision() {

        return Division::get();
    }

    public function createDivision($name) {

        Division::insert(array('name' => $name, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")));
        return true;
    }

    public function updateDivision($editName, $id) {

        Division::where( 'id', $id )->update(array( 'name'=>$editName, 'updated_at' => date('Y-m-d H:i:s') ));
        return true;
    }

    public function removeDivision($id) {

        Division::where( 'id', $id )->delete();
        return true;
    }

    public function fetchDivisionDepartment($department) {

        $data = array();
        foreach ($this->fetchAllDivision() as $division) {
            $dep = array();
            $dep['division'] = $division['name'];
            $dep['departments'] = $department->fetchDepartments($division['id']);
            array_push($data, $dep);
        }
        return $data;
    }

}
