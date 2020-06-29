@extends('Layouts.app')
@section('content')
<script src="{{ asset('js/repository.js') }}"></script>

<h1>Search</h1>

<p>This is where you search for books</p>

@include('Inc.messages')

@include('Inc.searchForm')

@include('Inc.searchResults')

@endsection
