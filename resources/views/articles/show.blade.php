{{-- 單一文章 --}}
@extends('layouts.app')

@section('content')
    <p> <a href="/articles">Go back</a></p>
    <h1>{{$a_id->title}}</h1>
    <p>{{$a_id->content}}</p>
    <small>{{ $a_id->created_at}}</small>

@endsection