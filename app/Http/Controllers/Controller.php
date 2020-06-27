<?php

namespace App\Http\Controllers;

use App\Book;
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

    public function Search(Request $request){

        if($request->input('search') == null){
            $books = Book::all();
        }
        else{
            $books = Book::where('title','LIKE', '%'.$request->input('search').'%')->get();
        }
        return view('Pages.search')->with('books', $books);
    }

    public function AddBook(){
        
        return view('Pages.add');
    }
}
