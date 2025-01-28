<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    
    public function validateCredentials(Request $request) {

        $users = Account::all();
        $found = 'invalid';
        for($i = 0; $i < count($users); $i++) {
            if($users[$i]['email'] === $request['email']) {
                if(password_verify($request['password'], $users[$i]['password'])) {
                // if($users[$i]['password'] === $request['password']) {
                    $request->session()->put('userId', $users[$i]['user_id']);
                    $found = 'correct';
                    break;
                } else {
                    $found = 'incorrect';
                    break;
                }
            }
        }
        return $found;
    }

}
