<?php

namespace App\Http\Controllers;

use App\test_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function Register(Request $request){
    	$user           = new test_user();
		$user->password = $request->input('password');
		$user->email    = $request->input('email');
        $user->name     = $request->input('name');
		$user->role     = $request->input('role');
		$result = $user->save();
        if($result){
            return response()->json([
            'error'  => false,
            'code'   => 200,
            'message'=> 'Registered successfully',
          ]);
        }else{
            return response()->json([
            'error'  => true,
            'code'   => 401,
            'message'=> 'Unauthorized'
          ]);
        }

    }

    public function Login(Request $request){
    	$user       = new test_user();
		$password   = $request->input('password');
		$email      = $request->input('email');
		$userRecord = test_user::whereEmail($email)->wherePassword($password)->first();
		if($userRecord){
			$token = encrypt($email.':'.$password);
            $user  = [
                'email' => $email,
                'role'  => $userRecord['role'] 
            ];
			return response()->json([
    		'error'  => false,
    		'code'   => 200,
    		'message'=> 'Logged in successfully',
    		'token'  => $token,
            'user'   => $user
    	  ]);
		}else{
			return response()->json([
    		'error'  => true,
    		'code'   => 401,
    		'message'=> 'Unauthorized'
    	  ]);
		}
    }

    public function Listing(Request $request){
        $offset = $request->input('offset');
        $limit  = $request->input('limit');
    	$users  = DB::table('test_user')
                ->select('id', 'name', 'email', 'role')
                ->orderBy('created_at', 'desc')
                ->offset($offset)
                ->limit($limit)
                ->get();
        $count  = \DB::table('test_user')->count();
        if($users){
            return response()->json([
            'error'  => false,
            'code'   => 200,
            'message'=> 'records get successfully!',
            'data'   => $users,
            'total'  => $count
          ]);
        }else{
            return response()->json([
            'error'  => true,
            'code'   => 400,
            'message'=> 'Bad Request',
            'data'   => $users
          ]);
        }
    }
}
