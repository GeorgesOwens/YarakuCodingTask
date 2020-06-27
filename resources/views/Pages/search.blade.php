@extends('Layouts.app')
@section('content')
    
    <h1>Search</h1>

    <p>This is where you search for books</p>
    @include('Inc.messages')


    {!! Form::open(['route'=>'search', 'method'=>'get']) !!}    

        <div class="form-group">
            {!! Form::text('search', '', ['class'=>'']) !!}
            
            {!! Form::submit('Search', ['class'=>'']) !!}
        </div>

        <strong>Search by</strong>
        <div>
            {!! Form::checkbox('searchby_title', '1', true) !!}
            {!! Form::label('searchby_title', 'Title') !!}
            {!! Form::checkbox('searchby_author') !!}
            {!! Form::label('searchby_author', 'Author') !!}
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