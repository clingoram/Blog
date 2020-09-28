{{-- 新增文章 --}}
@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>
    
    {!! Form::open(['action' => 'ArticlesController@store','method'=>'POST']) !!}
        <div class="form-group">
           {{Form::label('title','Title')}}
           {{Form::text('title','',['class'=>'form-control','placeholder'=>'Title Here'])}}
        </div>
        {{Form::checkbox('status', '1')}}
        <div class="form-group">
            {{Form::label('content','Content')}}
            {{Form::textarea('content','',['class'=>'form-control','row'=>3])}}
         </div>
         {{Form::submit('Submit',['class'=>'btn btn-primary'])}}

    {!! Form::close() !!}
@endsection