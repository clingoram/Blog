<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// get model
use App\Article;
use App\Userlog;

use DateTime;

// use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(isset(Auth::user()->id)){
            // get login member id
            $login_user_data = Auth::user()->id;
    
            $articles = DB::table('articles')->where('user_id','=',$login_user_data)->orderBy('id','desc')->get();
    
            return view('articles.index')->with('articles',$articles);
        }else{
            return redirect('/')->with('error','Please login.');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.new_story');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $now = new DateTime();

        // to get user data
        $login_user_data = Auth::user();

        $this->validate($request,[
            'title'=> 'required',
            'content'=>'required',
            'images' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg|max:1024'
        ]);

        $article = new Article;
        if($request->file('images')){

            // 請求取得上傳圖片的原始名稱
            $filename_to_store = $request->file('images')->getClientOriginalName();
            $extension = $request->file('images')->getClientOriginalExtension();
            $file_name = $filename_to_store;//.'_'.time().'_'.$extension;
            $file_path = $request->file('images')->storeAs('public/images',$file_name);

        }else{
            $file_name = 'no_image.jpeg';
        }
 
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->user_id = $login_user_data->id;
        $article->created_at = $now;
        $article->images = $file_name;

        $article->save();

        $now = new DateTime();
        // insert data into userlogs
        $memberlog = new Userlog;
        $memberlog->member_id = $login_user_data->id;
        $memberlog->note = $login_user_data->name.'已新增文章';
        $memberlog->updated_at = $now;
        $memberlog->save();


        return redirect('/articles')->with('success','New post');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
   
        $articles = DB::table('articles')->find($id);
        if($articles == ''){
            // 新增
            $title ='New Story';
            return view('articles.new_story')->with('title',$title);
        }else{
            return view('articles.show')->with('articles',$articles);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = DB::table('articles')->find($id);
        // 改url article id
        if(!isset($article) OR auth::user()->id !== $article->user_id){
            return redirect('/')->with('error','Error!!The permission is denied.');
        }
        return view('articles.edit')->with('articles',$article);
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
        // to get login user data
        $login_user_data = Auth::user();

        $this->validate($request,[
            'title'=> 'required',
            'content'=>'required',
            'images' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
             
        $article = Article::find($id);
        if($request->file('images') != null){

            // 請求取得上傳圖片的原始名稱
            $filename_to_store = $request->file('images')->getClientOriginalName();
            $extension = $request->file('images')->getClientOriginalExtension();
            $file_name = $filename_to_store;//.'_'.time().'_'.$extension;
            $file_path = $request->file('images')->storeAs('public/images',$file_name);

        }else{
            $file_name = 'no_image.jpeg';
        }
        
        $now = new DateTime();

        // $date_time = date("Y-m-d h:i:s a", time());
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->updated_at = $now;
        $article->user_id = $login_user_data->id;
        $article->images = $file_name;
        // $a = DB::table('articles')->toSql();
        $article->save();

        // insert data into userlogs
        $memberlog = new Userlog;
        $memberlog->member_id = $login_user_data->id;
        $memberlog->note =  $login_user_data->name.'已修改文章';
        $memberlog->updated_at = $now;
        $memberlog->save();

        return redirect('/articles')->with('success','Post updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        if(auth::user()->id !== $article->user_id){
            return redirect('/')->with('error','Error!!The permission is denied.');
        }
        $article->delete();

        // insert data into userlogs
        $insert_data = Auth::user();
        $now = new DateTime();
        $memberlog = new Userlog;
        $memberlog->member_id = $insert_data->id;
        $memberlog->note = $insert_data->name.'已刪除文章';
        $memberlog->updated_at = $now;
        $memberlog->save();

        return redirect('/articles')->with('success','Post removed!!');
    }
}
