{{-- 所有文章 --}}
@extends('layouts.app')

@section('content')
    <h1>Your stories</h1>

    @if(count($a_id) > 1)
        <div class="card">
            <ul class="list-group list-group-flush">
                @foreach($a_id as $key)
                    <li class="list-group-item">
                        <h5>
                            <a href="/articles/{{ $key->id }}">{{ $key->title }}</a> 
                            <small>{{ $key->created_at }}</small>
                        </h5>
                        <p>{{ $key->content }}</p>
                    </li>
                @endforeach
            </ul>
        </div>

    @endif

@endsection