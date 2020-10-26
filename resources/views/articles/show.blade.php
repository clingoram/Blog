{{-- 單一文章 --}}
@extends('layouts.app')

@section('content')
    @if(!Auth::guest())
        @if(Auth::user()->id == $articles->user_id)
            <p> <a href="/articles">Go back</a></p>

            <div class="card">
                <div class="card-header">
                    <h6>{{ $articles->created_at }} </h6>
                    
                    <a href="/articles/{{$articles->id}}/edit" id="edit_{{$articles->id}}" title="Edit" type="button" class="btn btn-primary btn-sm"><i class="far fa-edit"></i></a>

                    {{-- <button type="button" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                    </button> --}}
                    
                    {!! Form::open(['action'=>['ArticlesController@destroy',$articles->id],'method'=>'POST','class'=>'pull-right']) !!}
                    {{ Form::hidden('_method','DELETE') }}
                    {{ Form::submit('Delete',['class'=>'btn btn-danger btn-sm']) }}
                    {!! Form::close() !!}

                </div>
                <div class="card-body">
                <h3 class="card-title">{{ $articles->title }}</h3>
                <div class="col-8">
                    @if(isset($articles->images) AND $articles->images != 'no_image.jpeg')
                        <img style="width:200px" src="/storage/images/{{$articles->images}}">
                    @endif
                </div>
                <p class="card-text">{{ $articles->content }}</p>
                </div>
            </div>
        @endif
    @endif
@endsection