<?php

// Controller從Model拿資料。Model是PHP的物件，負責處理跟資料庫的互動跟資料庫的互動(拿取資料)
namespace App\Http\Controllers;

use Illuminate\Http\Request;

// get table
use App\Article;
// use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Log;

// 文章
// 打上:php artisan make:controller XxxController --resource
// 就會出現內建的index、create、store....


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
        // $articles = Article::all();

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
        // to get user data
        $login_user_data = Auth::user();

        $this->validate($request,[
            'title'=> 'required',
            'content'=>'required',
            'images' => 'image|nullable|mimes:jpeg,png,jpg,gif,svg|max:1024'
        ]);

        $article = new Article;
        if($request->file('images')){

            $filename_to_store = time().'.'.$request->file('images')->extension();
            $file_path = $request->file('images')->storeAs('public/images',$filename_to_store);

        }else{
            $filename_to_store = 'no_image.jpeg';
        }
 
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->user_id = $login_user_data->id;
        $article->images = $filename_to_store;//'/storage/'.$filename_to_store;
        // $a = DB::table('articles')->toSql();

        $article->save();

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
   
        // $article = Article::find($id);
        // $article = DB::table('articles')->find($id);
        // return view('articles.show')->with('article',$article);
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
             
        $article = new Article;
        if($request->file('images')){
            // $file_exist = $request->file('images')->getClientOriginalName();
            // // get file name
            // $filename = pathinfo($file_exist,PATHINFO_FILE);
            // $extension = $request->file('images')->extension();
            // $filename_to_store = $filename .'_'.time().'.'.$extension;
            // // upload image
            // $path = $request->file('images')->storeAs('public/images',$filename_to_store);

            $filename_to_store = time().'.'.$request->file('images')->extension();//->getClientOriginalName();
            $file_path = $request->file('images')->storeAs('public/images',$filename_to_store);

        }else{
            $filename_to_store = 'no_image.jpeg';
        }
 
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->user_id = $login_user_data->id;
        $article->images = $filename_to_store;
        // $a = DB::table('articles')->toSql();
        $article->save();

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
        return redirect('/articles')->with('success','Post removed!!');
    }
}
