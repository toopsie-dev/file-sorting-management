<?php

namespace App\Models;

use App\Models\Implementor;
use App\Models\Revision;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'id',
        'type',
        'title',
        'description',
        'author'
    ];

    public function implementors() {
        return $this->hasMany(Implementor::class);
    }

    public function revisions() {
        return $this->hasMany(Revision::class);
    }
}
