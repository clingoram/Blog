@extends('layouts.default')

@section('content')
    <h1>{{ $title }}</h1>

    @if(count($service) > 0)
        @foreach ($service as $item)
            <p> {{ $item }}</p>
        @endforeach
    @endif
@endsection