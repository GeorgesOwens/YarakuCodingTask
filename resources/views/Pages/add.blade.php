@extends('Layouts.app')
@section('content')

<h1>Add book</h1>

<p>This is where you add books</p>   

    @include('Inc.bookForm', ['routeUrl'=>route('storeBook')])

@endsection