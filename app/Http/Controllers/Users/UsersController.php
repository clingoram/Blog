<?php
// User to login,logout and register

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    // direct to login html page
    public function showLogin()
    {
        return view('users.login');
    }

    // login validation
    // check user's mail,password
    public function userLogin(Request $request)
    {
        // inputs datas that user typein
        $credentials = $request->only('email', 'password');

        $rules = [
            'email' => 'required|min:6|max:255',
            'password' => 'required|min:2|max:50'
        ];

        $validator = Validator::make($credentials, $rules);

        if ($validator->fails()) {
            $this->response->errorBadRequest($validator->errors());
            // return response()->json(['message' => $validator->errors(), 'status_code' => 400], 400);
        }

        $token = Auth::attempt($credentials);

        if (!$token) {
            return $this->response->error('登入失敗', 401);
            // return response()->json(['message' => '登入失敗', 'status_code' => 500], 500);
        }
        // dd($token);
    }

    // user logout
    public function userLogout(Request $request)
    {
        Auth::logout(true);
        return response()->json(['message' => '已登出'], 200);
    }

    // insert datas into two tables:
    // table 1: users
    // table 2: sitesettings
    public function userRegister()
    {
        // $credentials = $request->only('account','email', 'password');

        // $rules = [
        //     'account' => 'required|min:2|max:50',
        //     'email' => 'required|max:255|email|string|unique:users',
        //     'password' => 'required|min:8|string|confirmed'
        // ];
    }
}