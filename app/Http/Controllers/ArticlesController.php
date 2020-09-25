<?php

// Controller從Model拿資料。Model是PHP的物件，負責處理跟資料庫的互動跟資料庫的互動(拿取資料)
namespace App\Http\Controllers;

use Illuminate\Http\Request;

// get table
use App\Article;
use Illuminate\Support\Facades\DB;

// 文章
// 打上:php artisan make:controller XxxController --resource
// 就會出現內建的index、create、store....


class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $articles = Article::all();
        $articles = DB::table('articles')->orderBy('id','desc')->get();
        return view('articles.index')->with('articles',$articles);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title ='New Story';
        return view('articles.new_story')->with('title',$title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=> 'required',
            'content'=>'required'
        ]);
        
        $article = DB::table('articles')->insert(
            ['title' => $request->input('title')],
            ['content' => $request->input('content')],
            ['user_id' => 1]
            // ['status'=> $request->checkbox('status')],
        );
        // $article = new Article;
        // $article->title = $request->input('title');
        // $article->content = $request->input('content');
        // $article->user_id = 1; //auth()->id;
        // $article->save();

        return redirect('/articles')->witch('success','Article new_story');
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
        $article = DB::table('articles')->find($id);
        return view('articles.show')->with('article',$article);
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
