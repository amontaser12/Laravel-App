@extends('layouts.app')
    @section('content')
        <h2>{{$post->title}}</h2>
        <ul class="list-group">
            <li class="list-group-item">
                {!! $post->body !!}
                <hr>
                <small>Written On: {{ $post->created_at }}</small>
             </li>
             <hr>
        </ul>
        @if($user->id == $post->user_id)
            <a href="{{route('posts.edit' , $post->id)}}" class="btn btn-primary">Edit </a>
            {!!Form::open(['action'=>['PostsController@destroy' , $post->id], 'method' =>'POST'])!!}
                {{form::hidden('_method' ,"DELETE")}}
                {{Form::submit('Delete',['class'=> 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif    
    @endsection