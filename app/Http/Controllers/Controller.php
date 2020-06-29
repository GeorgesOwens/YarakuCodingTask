<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\ViewModels\SearchViewModel;

class Controller extends BaseController
{
    public function Index(){

        return view('Pages.index');
    }

    public function Repository(){
        $books = Book::all();

        $viewModel = new SearchViewModel();

        $viewModel->searchByFields = ['Title' => 1];

        return View('Pages.search')->with([
            'books'=> $books,
            'searchByFields' => Book::searchByFields,
            'searchViewModel' => $viewModel
            ]);
    }

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

    public function AddBook(){
        
        return view('Pages.add');
    }

    public function Edit($id){

        $book = Book::find($id);

        return view('Pages.edit')->with(['book' => $book, 'id' => $id]);
    }
}
