{{-- 單一文章 --}}
@extends('layouts.app')

@section('content')
    <p> <a href="/articles">Go back</a></p>
    <h1>{{ $articles->title }}
        <button type="button">
            <i class="far fa-edit"></i>
        </button>
    </h1>
    <p>{{ $articles->content }}</p>
    <small>{{ $articles->created_at }}</small>

@endsection