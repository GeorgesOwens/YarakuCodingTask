<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\ViewModels\SearchViewModel;

class SearchController extends Controller
{
    public function Search(Request $request){

        $searchViewModel = new SearchViewModel($request);

        if($searchViewModel->searchTerm == null){
            $books = Book::all();
        }
        else{
            $books = Book::select('*');

            foreach($searchViewModel->searchByFields as $searchByField){
                $books->orWhere($searchByField,'LIKE', '%'.$searchViewModel->searchTerm.'%');
            }

            $books = $books->get();
        }
        return view('Pages.search')->with([
            'books'=> $books, 
            'searchByFields' => Book::searchByFields,
            'searchViewModel' => $searchViewModel
            ]);
    }
}
