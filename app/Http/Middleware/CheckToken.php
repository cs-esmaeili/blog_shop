<?php

namespace App\Http\Middleware;

use App\Http\helpers\G;
use Closure;

class CheckToken
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
        if ($request->bearerToken() == null) {
            return response(['statusText' => 'fail', "description" => "token is not set"], 406);
        }
        $token = $request->bearerToken();
        $check = G::checkToken($token, true,substr($request->url(),strripos($request->url(),'/') + 1));
        if ($check['status'] == false) {
            return response(['statusText' => 'fail', "meessage" => $check['meessage']], 403);
        }
        return $next($request);
    }
}
