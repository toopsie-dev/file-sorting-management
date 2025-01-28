<?php

namespace App\Models;

use App\Models\Division;
use App\Models\Implementor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'division_id'
    ];

    public function division() {
        return $this->belongsTo(Division::class);
    }

    public function implementor() {
        return $this->belongsTo(Implementor::class);
    } 
}
