<?php

namespace App\Models;

use App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    use HasFactory;

    protected $table = 'revisions';

    protected $fillable = [
        'id',
        'post_id',
        'type',
        'document',
        'changes',
        'date'
    ];

    public function post() {
        return $this->hasOne(Post::class);
    }

    public function getDate($value) {
        return date('d M Y', strtotime($revision['date']));
    }
}
