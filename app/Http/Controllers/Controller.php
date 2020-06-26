<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function Index(){

        return view('Pages.index');
    }

    public function Search(){

        $books = Book::all();
        return view('Pages.search')->with('searchResults', $books);
    }

    public function AddBook(){
        
        return view('Pages.add');
    }
}
