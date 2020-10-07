<?php
// 網站設定
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SitesettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $management = DB::table('sitesettings')->orderBy('id','desc')->get();
        return view('managements.index')->with('managements',$management);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get login user's data
        $login_member_data = Auth::user();
        $member_account = $login_member_data->account;
        
        // site status(on/off)
        // $management_status = DB::table('sitesettings')->where('member_id','=',$login_member_data->id)->value('site_status');

        // SELECT users.id,users.name,users.account,users.status,sitesettings.member_id,sitesettings.site_status 
        // FROM users,sitesettings 
        // WHERE sitesettings.member_id = users.id

        // SELECT users.id,users.name,users.account,users.status,sitesettings.member_id,sitesettings.site_status 
        // FROM users 
        // INNER JOIN sitesettings 
        // ON sitesettings.member_id = users.id
        $data = DB::table('users')
            ->join('sitesettings','users.id','=','sitesettings.member_id');
        return view('sitesettings.settings')->with('managements',$data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
