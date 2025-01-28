<?php

namespace App\Repositories;

use App\Models\Department;
use App\Models\Implementor;
use App\Models\Post;
use App\Models\Revision;
use Faker\Provider\DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PostRepository
{
   
	public function createPost($request) {

    $postId = $this->savePost($request);
    $this->savePostImplementor($postId, $request['implementors']);
    $this->savePostRevision($postId, $request);
    return true;
  }

  public function savePost($request) {

    return $post_id = Post::insertGetId(
      array('type' => $request['type'],
        'title' => $request['title'],
        'description' => $request['description'],
        'author' => $request['author'],
        'division_id' => $request['division'],
        'image' => $request['image'],
        'status' => 1,
        'isConfirm' => 0,
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s")
      )
    );
  }

  public function savePostImplementor($postId, $implementors) {

    $implmentors = explode(',', $implementors);
    foreach($implmentors as $implementor) {
      Implementor::insert(
        array( 'post_id' => $postId,
          'dep_id' => $implementor, )
      );
    }
  }

  public function savePostRevision($postId, $request) {

    Revision::insert(
      array( 'post_id' => $postId,
        'type' => $request['docType'],
        'document' => $request['document'],
        'changes' => '',
        'revision_id' => '',
        'change_by' => $request['author'],
        'date' => date("Y-m-d H:i:s"),
        'status' => 1,
        'isConfirm' => 0
      )
    );
  }

  public function fetchAllPosts() {

    $data = array();
    foreach(Post::where('status', 1)->where('isConfirm', 1)->get() as $post) {
      $postDetail = array();
      $postDetail['post'] = $post;
      $string = '';
      $implementors = implementor::where( 'post_id', $post->id )->get();
      for ($y = 0; $y < count($implementors) ; $y++) {
        $string .= Department::find($implementors[$y]['dep_id'])->name . ', ';
        if($y == count($implementors) - 1) {
         $string = substr($string, 0, -2);
        }
      }
      $postDetail['stringImplementors'] = $string;
      $postDetail['date'] = date('d M Y', strtotime($post['created_at']));
      $postDetail['implementors'] = Implementor::where( 'post_id', $post->id )->get();
      $postDetail['revisions'] = Revision::where( 'post_id', $post->id )->orderBy('id', 'DESC')->first();
      array_push($data, $postDetail);
    }
    return $data;
  }

  public function editPost($request, $id) {
    if(empty($request['image'])) {
      Post::where('id', $id )->update(
        array( 'title' => $request['title'],
         'description' => $request['description'],
       )
      );
    } else {
      Post::where('id', $id )->update(
        array( 'title' => $request['title'],
         'description' => $request['description'],
         'image' => $request['image'],
       )
      );
    }
    implementor::where('post_id', $id)->delete();
    $this->savePostImplementor($id, $request['implementors']);
    return true;
  }

  public function removePost($id) {
    Post::where('id', $id )->update(
      array( 'status' => 0 )
    );
    return true;
  }

  public function filterType($type) {
    $posts = $this->fetchAllPosts();
    $filtered = array_filter($posts, function ($post) use($type) {
      return $post['post']->type === $type;
    });
    return $filtered;
  }

  public function retrievePost($id) {
    return Post::where('id', $id )->update(
      array( 'status' => 1 )
    );
  }
    


}
