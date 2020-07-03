<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function Store(Request $request){

        $request->validate(Book::FormValidationRules);

        $book = new Book($request->all());
        $book->save();

        return redirect('/add')
            ->with('success', 'Book added');
    }

    public function Remove(Book $book){

        $book->delete();

        return redirect('/repository')
            ->with('success', 'Book removed'); 
    }

    public function Update(Book $book, Request $request){

        $request->validate(Book::FormValidationRules);

        $book->fill($request->all());
        $book->save();

        return redirect('/repository')->with('success', 'Book updated');
    }
}
