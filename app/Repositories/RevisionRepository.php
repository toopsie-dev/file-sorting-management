<?php

namespace App\Repositories;

use App\Models\Department;
use App\Models\Division;
use App\Models\Post;
use App\Models\Revision;
use App\Models\implementor;
use Faker\Provider\DateTime;
use Illuminate\Database\Eloquent\Model;

class RevisionRepository
{
   
    public function retrievePost($postId) {

        $string = '';
        $postDetails = array();
        $postDetails['post'] = Post::find($postId);
        $implementors = Implementor::where('post_id', $postId)->get();
        for ($y = 0; $y < count($implementors) ; $y++) {
            $string .= Department::find($implementors[$y]['dep_id'])->name . '/ ';
            if($y == count($implementors) - 1) {
               $string = substr($string, 0, -2);
            }
        }
        $postDetails['implementors'] = $string;
        $postDetails['latestDocument'] = Revision::select('document', 'type')->where('post_id', $postId)->orderBy('id', 'DESC')->first();
        return $postDetails;
    }

    public function addRevision($postId, $request) {

        if($request['image'] == '') {
            Post::where('id', $postId )->update(
                array(
                    'title' => $request['title'],
                    'description' => $request['changes'],
                    'division_id' => $request['division']
                )
            );
        } else {
             Post::where('id', $postId )->update(
                array(
                    'title' => $request['title'],
                    'description' => $request['changes'],
                    'division_id' => $request['division'],
                    'image' => $request['image'],
                )
            );
        }
       
        Implementor::where('post_id', $postId)->delete();
        $implementors = explode(',', $request['departments']);
        foreach($implementors as $implementor) {
            implementor::insert(
            array( 'post_id' => $postId,
              'dep_id' => $implementor )
            );
        }

        Revision::insert(
            array( 'post_id' => $postId,
                'type' => $request['type'],
                'document' => $request['document'],
                'changes' => $request['changes'],
                'revision_id' => $request['revisionId'],
                'change_by' => $request['change_by'],
                'date' => date("Y-m-d H:i:s"),
                'status' => 1,
                'isConfirm' => 0
            )
        );

        return true;
    }



}
