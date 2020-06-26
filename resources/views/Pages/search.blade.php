@extends('Layouts.app')
@section('content')
    
    <h1>Search</h1>

    <p>This is where you search for books</p>

    @if(count($searchResults) > 0)
        @foreach ($searchResults as $result)
            <h3>{{$result->Title}}</h3>
            <small>{{$result->Author}}</small>
        
        @endforeach
    @else
        <p>No results found</p>
    @endif

@endsection