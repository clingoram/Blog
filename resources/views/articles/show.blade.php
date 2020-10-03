{{-- 單一文章 --}}
@extends('layouts.app')

@section('content')
    <p> <a href="/articles">Go back</a></p>

    <div class="card">
        <div class="card-header">
            <h6>{{ $articles->created_at }} </h6>
            
            <a href="/articles/{{$articles->id}}/edit" id="edit_{{$articles->id}}" title="Edit" type="button" class="btn btn-primary btn-sm"><i class="far fa-edit"></i></a>

            <button type="button" class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i>
            </button>

        </div>
        <div class="card-body">
          <h3 class="card-title">{{ $articles->title }}</h3>
          <p class="card-text">{{ $articles->content }}</p>
        </div>
    </div>

    {{-- {{!!Form::open(['action'=>['ArticlesController@destory',$articles->id],'method'=>'POST','class'=>'pull-right'])!!}}
    {{Form::hidden('_method','DELETE')}}
    {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
    {!!Form::close()!!} --}}

@endsection