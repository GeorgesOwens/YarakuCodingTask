<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function Store(Request $request){

        $request->validate([
            'title' => 'required',
            'author' => 'required'
        ]);

        $book = new Book;
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->save();

        return redirect('/add')->with('success', 'Book added');
    }

    public function Remove($id){

        $book = Book::find($id);
        $book->delete();

        return redirect('/repository')->with('success', 'Book removed'); 
    }
}
