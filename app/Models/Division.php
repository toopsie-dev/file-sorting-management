<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $table = 'divisions';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function departments() {
        return $this->hasMany(Department::class);
    }


}
