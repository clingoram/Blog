{{-- 單一文章 --}}
@extends('layouts.app')

@section('content')
    <h1>{{$article->title}}</h1>
    <p>{{$article->content}}</p>

@endsection