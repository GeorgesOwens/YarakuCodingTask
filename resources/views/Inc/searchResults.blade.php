@if(count($books) > 0)
    <table class="table">
        <thead>
            <tr>
                <th width="40%">Title</th>
                <th width="40%">Author</th>
                <th width="10%">Edit</th>
                <th width="10%">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>
                        {{ $book->Title }}
                    </td>
                    <td>
                        {{ $book->Author }}
                    </td>
                    <td>
                        <a href="edit/{{ $book->id }}">
                            <span class="glyphicon glyphicon-cog"></span>
                        </a>
                    </td>
                    <td>
                        {!! Form::open(['url' => 'book/remove/'.$book->id, 'method' => 'post']) !!}
                        <button type="submit" class="confirmation" style="background:none;border:none;padding:0">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $books->links() }}
@else
    <p>No results found</p>
@endif
