<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Carbon\Exceptions\InvalidDateException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\InvalidDataProviderException;

class BookController extends Controller
{
    public function Store(Request $request){

        $request->validate(Book::FormValidationRules);

        $book = new Book($request->all());
        
        try{

            $book->save();

            Log::info('Book Added: '.$book->Title);
        }
        catch(\Exception $e){

            Log::error($e);

            return redirect()->back()
                ->withInput()
                ->with('error', 'An error was encountered, book not added');
        }

        return redirect('/add')
            ->with('success', 'Book added');
    }

    public function Remove(Book $book){

        try{

            $book->delete();

            Log::info('Book removed: '. $book->Title);
        }
        catch(\Exception $e)
        {
            Log::error($e);

            return redirect()->back()
                ->with('error', 'An error was encountered, book not removed');
        }

        return redirect('/repository')
            ->with('success', 'Book removed'); 
    }

    public function Update(Book $book, Request $request){

        $request->validate(Book::FormValidationRules);

        $book->fill($request->all());

        try{
            $book->save();

        }
        catch(\Exception $e){

            Log::error($e);

            return redirect()->back()
                ->with('error', 'An error was encountered, book not updated');
        }

        return redirect('/repository')->with('success', 'Book updated');
    }
}
