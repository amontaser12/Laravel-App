@extends('layouts.app')

    @section('content')
        <h2>Posts</h2>
        <div class="jumbotron">
            <div class="container">
                @if(count($post) > 0)
                    @foreach($post as $one)
                        <div class="col-xs-4">
                            <img src="storage/cover_image/{{$one->cover_image}}" alt="">
                        </div>
                        <div class="col-xs-8">
                            <ul class="list-group">
                                <li class="list-group-item"><a href="{{ route('posts.show' , $one->id)}}">{{ $one->title}}</a></li>
                            </ul>
                        </div>    
                    @endforeach
                    <a href="{{route('posts.create')}}" class="btn btn-primary"> Create</a>
                @else
                    <p>no posts found</p>
                @endif    
            </div>
      </div>
        
    @endsection