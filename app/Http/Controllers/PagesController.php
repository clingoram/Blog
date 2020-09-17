<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'My Blog';
        // return view('pages.index',compact('title'));
        return view('pages.index')->with('title',$title);

    }

    public function about(){
        $title = 'About this blog';
        return view('pages.about')->with('title',$title);
    }

    public function services(){
        $data = array(
            'title'=> 'Service',
            'service'=> ['no service','web']
        );
        return view('pages.services')->with($data);
    }
}
