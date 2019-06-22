<?php

namespace App\Http\Middleware;

use App\test_user;
use Closure;

class AllowUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = decrypt($request->header('Authorization'));
        $user = explode(':', $token);
        $userRecord = test_user::whereEmail($user[0])->wherePassword($user[1])->first();
        if($userRecord){
            return $next($request);
        }
        return response()->json([
            'error'  => true,
            'code'   => 401,
            'message'=> 'Unauthorized'
          ]);
    }
}
