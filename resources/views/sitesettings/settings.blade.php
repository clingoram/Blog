{{-- 網站設定 --}}
@extends('layouts.app')

@section('content')
    <h1>Settings</h1>
    <div class="container">
        <div class="row">
          <div class="col-4">
            {{Form::label('account', 'Account',['class' => "text","id"=>"inputGroup-sizing-sm"])}}
          </div>
          <div class="col-6">
            {{-- <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"> --}}
            {{ Form::text('title',$managements->account,['class' => 'form-control','placeholder' => 'Title Here','aria-label'=>"Small",'aria-describedby'=>"inputGroup-sizing-sm"]) }}
          </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
          <div class="col-4">
            {{Form::label('site_status', 'Status',['class' => "text"])}}
          </div>
          <div class="col-6">
            <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
          </div>
        </div>
    </div>
    

@endsection