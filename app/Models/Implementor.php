<?php

namespace App\Models;

use App\Models\Department;
use App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Implementor extends Model
{
    use HasFactory;

    protected $table = 'implementors';

    protected $fillable = [
        'post_id',
        'dep_id'
    ];

    public function posts() {
        return $this->hasMany(Post::class);
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }
}
