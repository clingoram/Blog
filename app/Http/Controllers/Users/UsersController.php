<?php
// User to login,logout and register

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return 'he';
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
