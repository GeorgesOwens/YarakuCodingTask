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
        $books = Book::select('*')->orderBy('Title', 'asc')->get();

        $viewModel = new SearchViewModel();

        $viewModel->searchByFields = ['Title' => 1];
        $viewModel->orderByField = 'Title';

        return View('Pages.search')->with([
            'books'=> $books,
            'searchViewModel' => $viewModel
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
