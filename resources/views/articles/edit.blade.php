{{-- 編輯 --}}
@extends('layouts.app')

@section('content')
    <h1>Edit story</h1>
    
    {!! Form::open(['action' => ['ArticlesController@update',$articles->id],'method'=>'POST']) !!}
        <div class="form-group">
           {{Form::label('title','Title')}}
           {{Form::text('title',$articles->title,['class'=>'form-control','placeholder'=>'Title Here'])}}
        </div>

        {{Form::checkbox('status', '1')}}
        <div class="form-group">
            {{Form::label('content','Content')}}
            {{Form::textarea('content',$articles->content,['class'=>'form-control','row'=>3])}}
        </div>

        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}

    {!! Form::close() !!}

@endsection