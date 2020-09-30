{{-- 所有文章 --}}
@extends('layouts.app')

@section('content')

    @if(count($articles) >= 1)
        <h1>Your stories</h1>
        <table>
            <thead>
            </thead>
            <tfoot>

            </tfoot>
            <tbody>
                @foreach($articles as $key)
                    <a href="/articles/{{ $key->id }}">{{ $key->title }}</a> 
                    <small>{{ $key->created_at }}</small>

                    <a href="/articles/{{$key->id}}/edit" id="edit_{{$key->id}}" title="edit"><i class="far fa-edit"></i></a>

                    <p>{{ $key->content }}</p>
                @endforeach
            </tbody>
        </table>

        {{-- <div class="card">
            <ul class="list-group list-group-flush">
                @foreach($articles as $key)
                    <li class="list-group-item">
                        <h5>
                            <a href="/articles/{{ $key->id }}">{{ $key->title }}</a> 
                            <small>{{ $key->created_at }}</small>
                        </h5>
                        <p>{{ $key->content }}</p>
                    </li>
                @endforeach
            </ul>
        </div> --}}
    @else
        <h1>Oops!<br>You don't have any posts yet.</h1>
        <button type="button" class="btn btn-light"><a href="/articles/new_story">Add new posts</a></button>
    @endif
    
@endsection