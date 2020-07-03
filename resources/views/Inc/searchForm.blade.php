{!! Form::open(['route'=>'search', 'method'=>'get', 'class'=>'form-group']) !!}

    <div class="form-group">
        {!! Form::text('searchTerm', $searchViewModel->searchTerm, ['class'=>'']) !!}

        {!! Form::submit('Search', ['class'=>'']) !!}
    </div>

    <div>
        <strong>Search By</strong>
        <br />
        @foreach(Book::GetFieldsWithMeta('Searchable') as $searchByField)
            {!! Form::checkbox('searchBy[]', $searchByField,
                $searchViewModel->HasSearchByField($searchByField)) !!}
            {!! Form::label('searchBy[]', $searchByField) !!}
        @endforeach
    </div>

    <div>
        <strong>Order By</strong>
        <br />
        {{-- Combined orderable fields with themselves so that the select's name and value would be the same --}}
        {!! Form::select('orderBy',  Book::GetFieldsWithMeta('Orderable')->combine(Book::GetFieldsWithMeta('Orderable')), $searchViewModel->orderByField, []) !!}
        
        <span class="glyphicon glyphicon-chevron-down"></span>
        {!! Form::radio('order', 'asc', ($searchViewModel->order == 'asc')?true:false, []) !!}
        <span class="glyphicon glyphicon-chevron-up"></span>
        {!! Form::radio('order', 'desc', ($searchViewModel->order == 'desc')?true:false, []) !!}
    </div>


{!! Form::close() !!}
