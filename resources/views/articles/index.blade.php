{{-- 所有文章 --}}
@extends('layouts.app')

@section('content')

    @if(count($articles) >= 1)
        <h1>Your stories</h1>
        <table class="table">
            <thead>
            </thead>
            <tfoot>

            </tfoot>
            <tbody>
                @foreach($articles as $key)
                    <tr>
                        <th scope="row"></th>
                        <td> <a href="/articles/{{ $key->id }}">{{ $key->title }}</a> </td>
                        <td> <p>{{ $key->content }}</p></td>
                        <td> <small>{{ $key->updated_at }}</small></td>
                        <td> <a href="/articles/{{$key->id}}/edit" id="edit_{{$key->id}}" title="Edit"><i class="far fa-edit"></i></a></td> 
                    </tr>    
                @endforeach
            </tbody>
        </table>
    @else
        <h1>Oops!<br>You don't have any posts yet.</h1>
        <button type="button" class="btn btn-light"><a href="/articles/new_story">Add new posts</a></button>
    @endif
    
@endsection