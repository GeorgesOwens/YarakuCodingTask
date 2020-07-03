@include('Inc.messages')  
{!! Form::open(['url'=>$routeUrl, 'methode'=>'post']) !!}
<div class="form-group">
    {!! Form::label('Title', 'Title') !!}
    {!! Form::text('Title', $book->Title ?? '', ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Author', 'Author') !!}
    {!! Form::text('Author', $book->Author ?? '', ['class'=>'form-control']) !!}
</div>
{!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
{!! Form::close() !!}