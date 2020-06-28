@extends('Layouts.app')
@section('content')

<h1>Edit book</h1>

@include('Inc.bookForm', ['routeUrl'=>route('bookUpdate', ['id' => $id])])

@endsection