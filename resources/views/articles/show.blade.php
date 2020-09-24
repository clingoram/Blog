{{-- 單一文章 --}}
@extends('layouts.app')

@section('content')
    <p> <a href="/articles">Go back</a></p>
    <h1>{{$article->title}}</h1>
    <p>{{$article->content}}</p>
    <small>{{ $article->created_at}}</small>

@endsection