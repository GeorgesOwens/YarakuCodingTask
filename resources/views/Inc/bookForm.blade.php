@include('Inc.messages')  
{!! Form::open(['url'=>$routeUrl, 'methode'=>'post']) !!}
    @foreach ($displayedFields as $field)
        <div class="form-group">
            {!! Form::label($field, $field) !!}
            {!! Form::text($field, $book->$field ?? '', ['class'=>'form-control']) !!}
        </div>    
    @endforeach
{!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
{!! Form::close() !!}