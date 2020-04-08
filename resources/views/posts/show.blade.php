@extends('layouts.app')

@section('content')
    <!-- Back button -->
    <a href="./." class="btn btn-default">Go Back</a>
    <h1>{{$post->title}}</h1>
    <div>
        {{$post->body}}    
    </div>
    <hr>
    <small>Written on {{$post->created_at}}</small>
@endsection