<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    public function Index(){

        return view('Pages.index');
    }

    public function Repository(){
        $books = Book::all();

        return View('Pages.search')->with('books', $books);
    }

    public function Search(Request $request){

        $request->validate([
            'searchby_title' => 'required_without_all:searchby_author',
            'searchby_author' => 'required_without_all:searchby_title'
        ]);

        if($request->input('search') == null){
            $books = Book::all();
        }
        else{
            $books = Book::select('*');

            if($request->input('searchby_title') != null){
                $books->orWhere('title','LIKE', '%'.$request->input('search').'%');
            }
            if($request->input('searchby_author') != null){
                $books->orWhere('author','LIKE', '%'.$request->input('search').'%');
            }

            $books = $books->get();
        }
        return view('Pages.search')->with('books', $books);
    }

    public function AddBook(){
        
        return view('Pages.add');
    }

    public function Edit($id){

        $book = Book::find($id);

        return view('Pages.edit')->with(['book' => $book, 'id' => $id]);
    }
}
