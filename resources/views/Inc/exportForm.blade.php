{!! Form::open(['route' => 'export', 'method'=>'get', 'class'=>'form-group']) !!}
    
    <button type="submit" class="btn btn-primary">
        <span class="glyphicon glyphicon-save"></span>
        Export
    </button>

    {!! Form::select('exportFormat', ['CSV' => 'CSV', 'XML'=>'XML'], null, []) !!}

    @foreach (Book::exportable as $exportable)
        {!! Form::checkbox('fieldsToExport[]', $exportable, true, []) !!}
        {!! Form::label('fieldsToExport', $exportable, []) !!}
    @endforeach

    {!! Form::hidden('searchTerm', $searchViewModel->searchTerm) !!}
    {!! Form::hidden('orderBy', $searchViewModel->orderByField) !!}
    {!! Form::hidden('order', $searchViewModel->order) !!}
    
    @foreach ($searchViewModel->searchByFields as $searchByField)
       
        {!! Form::hidden('searchBy[]', $searchByField) !!}
    @endforeach

{!! Form::close() !!}