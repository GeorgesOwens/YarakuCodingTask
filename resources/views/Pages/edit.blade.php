@extends('Layouts.app')
@section('content')

<h1>Edit book</h1>

@include('Inc.bookForm', [
    'routeUrl' => route('bookUpdate', ['book' => $id]), 
    'displayedFields' => Book::GetFieldsWithMeta('Editable')
    ])

@endsection