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
                        <a href="book/remove/{{ $book->id }}" class="confirmation">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No results found</p>
@endif
