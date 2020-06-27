@extends('Layouts.app')
@section('content')

<h1>Add book</h1>

<p>This is where you add books</p>
    
    @include('Inc.messages')    

    {!! Form::open(['route'=>'storeBook', 'methode'=>'post']) !!}
    <div class="form-group">
        {!! Form::label('title', 'Title') !!}
        {!! Form::text('title', '', ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('author', 'Author') !!}
        {!! Form::text('author', '', ['class'=>'form-control']) !!}
    </div>
    {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection