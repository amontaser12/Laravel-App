@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="jumbotron">
                    <div class="container">
                        @if(count($post) > 0)
                            <h2>Posts</h2>
                                @foreach($post as $one)
                                    <ul class="list-group">
                                        <li class="list-group-item"><a href="{{ route('posts.show' , $one->id)}}">{{ $one->title}}</a></li>
                                    </ul>
                                @endforeach
                                @if($user->id == $user_id)
                                    <a href="{{route('posts.create')}}" class="btn btn-primary">Create</a>
                                @endif    
                        @else
                            <p>no posts found</p>
                        @endif    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
