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
        <table class="table">
            <thead>
                <tr>
                    <th width="40%">Title</th>
                    <th width="40%">Author</th>
                    <th width="10%">Edit</th>
                    <th width="10%">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                <tr>
                    <td>
                        {{$book->Title}}
                    </td>
                    <td>
                        {{$book->Author}}
                    </td>
                    <td></td>
                    <td>
                        <a href="book/remove/{{$book->id}}">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No results found</p>
    @endif

@endsection