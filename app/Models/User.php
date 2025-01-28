<?php

namespace App\Models;

use App\Models\Account;
use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;


    public function account() {
        return $this->hasOne(Account::class);
    }

    public function departments() {
        return $this->hasMany(Department::class);
    }
}
