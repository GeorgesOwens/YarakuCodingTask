@extends('Layouts.app')
@section('content')
    
    <h1>Search</h1>

    <p>This is where you search for books</p>

    {!! Form::open(['action'=>'Controller@Search', 'method'=>'get']) !!}    

        <div class="form-group">
            {!! Form::text('search', '', ['class'=>'']) !!}
            
            {!! Form::submit('Search', ['class'=>'']) !!}
        </div>

    {!! Form::close() !!}

    @if(count($books) > 0)
        @foreach ($books as $book)
            <h3>{{$book->Title}}</h3>
            <small>{{$book->Author}}</small>
        
        @endforeach
    @else
        <p>No results found</p>
    @endif

@endsection