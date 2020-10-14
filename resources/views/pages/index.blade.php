{{-- 首頁 --}}
@extends('layouts.app')

@section('content')
    <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">{{ $title ?? 'Laravel Blog'}}</h1>
    </div>
  </div>
    
@endsection