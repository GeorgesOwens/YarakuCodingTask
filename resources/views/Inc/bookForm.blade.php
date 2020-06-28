{!! Form::open(['url'=>$routeUrl, 'methode'=>'post']) !!}
<div class="form-group">
    {!! Form::label('title', 'Title') !!}
    {!! Form::text('title', $book->Title ?? '', ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('author', 'Author') !!}
    {!! Form::text('author', $book->Author ?? '', ['class'=>'form-control']) !!}
</div>
{!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
{!! Form::close() !!}