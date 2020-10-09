<?php
// User to login,logout and register

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __contruct()
    // {

    // }

    public function signIn()
    {
        return view('auth.login');
    }

    public function singUp()
    {
        return 'sign';
    }

    public function signOut()
    {
        return 'out';
    }
}
