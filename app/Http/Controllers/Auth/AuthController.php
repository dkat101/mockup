<?php

namespace App\Http\Controllers\Auth;

use Auth;
use JWTAuth;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->error('Invalid credentials', 401);
            }
        } catch (\JWTException $e) {
            return response()->error('Could not create token', 500);
        }

        $user = Auth::user();

        return response()->success(compact('user', 'token'));
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'f_name' => 'required|string',
            'l_name' => 'required|string',
            'email'      => 'required|email|unique:users',
            'password'   => 'required|min:8',
        ]);

        $user = new User;
        if($request->input('u_id') != '') {
            $user->u_id = $request->input('u_id');
            //$user->remember_token = $request->input('remember_token');
        } else {
            $user->u_id = Uuid::uuid();
            //$user->remember_token = str_random(10);
        }
        $user->f_name = $request->input('f_name');
        $user->l_name = $request->input('l_name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));


        return response()->success($user->save());
    }
}
