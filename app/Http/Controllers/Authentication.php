<?php

namespace App\Http\Controllers;

use App\Http\helpers\G;
use App\Http\Requests\logIn;
use App\Http\Requests\logOut;
use App\Models\Person;
use App\Models\Token;

class Authentication extends Controller
{
    public function logIn(logIn $request)
    {
        $content =  json_decode($request->getContent());
        $person = Person::where('username', '=', G::changeWords($content->username))
            ->where('password', '=', G::getHash(G::changeWords($content->password)))->get();
        if ($person->count() == 1) {
            $person = $person[0];
            if ($person->status == 'deactive') {
                return response(['statusText' => 'fail', 'meessage' => 'کاربر غیر فعال است'], 200);
            }
            $token = $person->token;
            $token = G::newToken($person->person_id, $token->token_id, 30)['token'];


            $permission = $person->role->permissions()->select(['name'])->get()->toArray();
            $permission_new = [];
            foreach ($permission as $value) {
                $permission_new[] = $value['name'];
            }

            return response(['statusText' => 'ok', 'token' => $token, 'informations' => ['data' => $person->informations(), 'permissions' => $permission_new]], 200);
        }
        return response(['statusText' => 'fail', 'message' => "نام کاربری یا رمز عبور اشتباه است"], 200);
    }
    public function logOut(logOut $request)
    {
        $content =  json_decode($request->getContent());
        $token = $content->token;
        Token::where('token', '=', $token)->update([
            'expiration' => G::timeNow(),
        ]);
        return response(['statusText' => 'ok'], 200);
    }
}
