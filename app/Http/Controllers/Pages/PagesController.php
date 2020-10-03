<?php
// Controller從Model拿資料。Model是PHP的物件，負責處理跟資料庫的互動跟資料庫的互動(拿取資料)

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// 頁面連結
class PagesController extends Controller
{
    // 首頁
    public function index(){

        $member_login = Auth::user();
        if($member_login == ''){
            $intro = 'Laravel Blog';
        }else{
            $intro = 'Welcome Back,'.$member_login->name.'.';
        }
        return view('pages.index')->with('title',$intro);
    }

    public function about(){
        $title = 'About this blog';
        return view('pages.about')->with('title',$title);
    }

    // 新增文章
    // public function new_story(){
    //     $title ='New';
    //     // folder:articles
    //     return view('articles.new_story')->with('title',$title);
    // }

    // 設定網站(名稱)
    // public function settings(){
    //     $data = array(
    //         'title'=> 'Settings',
    //         'service'=> ['no service','web']
    //     );
    //     return view('sitesettings.settings')->with($data);
    // }
}
