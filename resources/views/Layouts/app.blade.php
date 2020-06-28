<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{asset('js/app.js')}}"></script>
        <title>{{config('app.name')}}</title>
    </head>
    <body>
        @include('Inc.navbar')
        <div class="container">
            @yield('content')
        </div>

    </body>
</html>