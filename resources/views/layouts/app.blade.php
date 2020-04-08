<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
        <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
        <title>{{config('app.name','LSAPP')}}</title>
    </head>
    <body>
        <div>@include('inc.navbar')</div>
        <div class="container">
            @include('inc.messages')
            @yield('content')
        </div>
        <script>
            CKEDITOR.replace( 'editor1' );
    </script>
    </body>
</html>
