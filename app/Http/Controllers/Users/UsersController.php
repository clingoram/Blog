<?php
// User to login,logout and register

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// models
use App\User;
use App\Userlog;
use App\Sitesetting;

use DateTime;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Gate;

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
        // inputs datas that user type in
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

        // validation,success = true;fail = false
        $token = Auth::attempt($credentials);

        if (!$token) {
            return $this->response->error('登入失敗', 401);
            // return response()->json(['message' => '登入失敗', 'status_code' => 500], 500);
        }
        if(Auth::check()){
            $insert_data = Auth::user();
            // insert data into userlogs
            $insert_userlog = Userlog::create([
                'member_id' => $insert_data->id,
                'note' => $insert_data->name.'已登入',
                'updated_at' => date("Y-m-d h:i:s a", time()),
            ]);
        }

        return view('home');
    }

    // user logout
    public function userLogout()
    {
        if(Auth::check()){
            $insert_data = Auth::user();
            // insert data into userlogs
            $insert_userlog = Userlog::create([
                'member_id' => $insert_data->id,
                'note' => $insert_data->name.'已登出',
                'updated_at' => date("Y-m-d h:i:s a", time()),
            ]);

            Auth::logout(true);
        }else{
            return response()->json(['message' => '錯誤', 'status_code' => 500], 500);
        }

        return view('pages.index');//response()->json(['message' => '已登出'], 200);
    }

    // direct to register page
    public function showRegister()
    {
        return view('users.register');
    }

    // When user register,insert datas into two tables:
    // table 1: users
    // table 2: sitesettings
    public function userRegister(Request $request)
    {
        $datas = $request->all();
   
        $rules = [
            'account' => 'required|min:2|max:50|unique:users',
            'name' => 'required|min:10|max:50|string',
            'email' => 'required|max:255|email|string|unique:users',
            'password' => 'required|min:8|string|confirmed'
        ];

        $validator = Validator::make($datas, $rules);
        
        if ($validator->fails()) {
            // $this->response->errorBadRequest($validator->errors());
            return response()->json(['message' => $validator->errors(), 'status_code' => 400], 400);
        }

        // $find_user = DB::table('users')->where('account', $datas['name'])->exists();
        $find_user = User::where('account', $datas['name'])->exists();

        if ($find_user != false) {
            return response()->json(['message'=>'帳號重複','status_code'=>409],409);
            // return $this->response->error('帳號重複', 409);
        }
        $now = new DateTime();

        // Insert data when user register success
        $insert_user = User::create([
            'account' => $datas['account'],
            'name' => $datas['name'],
            'email' => $datas['email'],
            'password' => Hash::make($datas['password']),
            'status' => 1,
            'role' => 'M',
            'register_time' => $now,
            'updated_at' => $now,
            'created_at' => $now
        ]);
        
        $find_max_user_id = User::find(DB::table('users')->max('id'));
        $increase = $find_max_user_id+1;

        // Insert sitesetting when user register
        $insert_sitesetting = Sitesetting::create([
            'member_id' => $increase,
            'created_at' => $now,
            'updated_at' => $now,
            'site_status' => 'on'
        ]);
        
        // Insert user log
        $insert_userlog = Userlog::create([
            'member_id' => $insert_sitesetting['member_id'],
            'note' => $datas['name'].'註冊',
            'updated_at' => date("Y-m-d h:i:s a", time())
        ]);

        return view('home');
    }
}