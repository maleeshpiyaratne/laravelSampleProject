@extends('layouts.app')
@section('content')
    <h1><?php echo $title; ?></h1>
    <!--<p>This is the laravel application form the youtube channel Traversy Media</p>-->

    @if(count($services) > 0)
    <ul class="list-group">
        @foreach($services as $service)
            <li class="list-group-item">{{$service}}</li>
        @endforeach
    </ul>
    @endif
    
@endsection