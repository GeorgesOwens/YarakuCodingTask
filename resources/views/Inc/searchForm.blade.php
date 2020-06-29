{!! Form::open(['route'=>'search', 'method'=>'get', 'class'=>'form-group']) !!}

    <div class="form-group">
        {!! Form::text('searchTerm', $searchViewModel->searchTerm, ['class'=>'']) !!}

        {!! Form::submit('Search', ['class'=>'']) !!}
    </div>

    <div>
        <strong>Search By</strong>
        <br />
        @foreach(Book::searchByFields as $searchByField)
        {!! Form::checkbox('searchBy['.$searchByField.']', $searchByField,
        $searchViewModel->HasSearchByField($searchByField)) !!}
        {!! Form::label('searchBy['.$searchByField.']', $searchByField) !!}
        @endforeach
    </div>

    <div>
        <strong>Order By</strong>
        <br />
        {!! Form::select('orderBy', Book::orderByFields, $searchViewModel->orderByField, []) !!}
        
        <span class="glyphicon glyphicon-chevron-down"></span>
        {!! Form::radio('order', 'asc', ($searchViewModel->order == 'asc')?true:false, []) !!}
        <span class="glyphicon glyphicon-chevron-up"></span>
        {!! Form::radio('order', 'desc', ($searchViewModel->order == 'desc')?true:false, []) !!}
    </div>


{!! Form::close() !!}
