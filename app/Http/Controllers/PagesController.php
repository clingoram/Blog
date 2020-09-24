<?php
// Controller從Model拿資料。Model是PHP的物件，負責處理跟資料庫的互動跟資料庫的互動(拿取資料)

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 頁面連結
class PagesController extends Controller
{
    // 首頁
    public function index(){
        $title = 'My Blog';
        // return view('pages.index',compact('title'));
        return view('pages.index')->with('title',$title);

    }

    public function about(){
        $title = 'About this blog';
        return view('pages.about')->with('title',$title);
    }

    // 新增文章
    // public function new_story(){
    //     $title ='New';
    //     return view('articles.new_story')->with('title',$title);
    // }

    // 設定網站(名稱)
    public function settings(){
        $data = array(
            'title'=> 'Settings',
            'service'=> ['no service','web']
        );
        return view('managements.settings')->with($data);
    }
}
