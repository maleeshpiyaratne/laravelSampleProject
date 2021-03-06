@extends('layouts.app')

@section('content')
    <!-- Back button -->
    <a href="./." class="btn btn-default">Go Back</a>
    <h1>{{$post->title}}</h1>
    <img style="width:100%" src="./storage/cover_image/{{$post->cover_image}}">
    <br><br>
    <div>
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    
    @if(!Auth::guest())
        <hr>
        <a href="../posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
    
        {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method'=>'POST', 'class'=>'float-right'])!!}
            {{Form::hidden('_method','DELETE')}}
            {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
        {!! Form::close() !!}
    @endif
@endsection