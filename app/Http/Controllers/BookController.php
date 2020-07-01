<?php

namespace App\Http\Controllers;

use App\Models\Book;
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

    public function Update(Request $request, $id){

        $request->validate([
            'title' => 'required',
            'author' => 'required'
        ]);

        $book = Book::find($id);

        if($book->Title != $request->input('title')){
            $book->Title = $request->input('title');
        }
        
        if($book->Author != $request->input('author')){
            $book->Author = $request->input('author');
        }

        $book->save();

        return redirect('/repository')->with('success', 'Book updated');
    }
}
