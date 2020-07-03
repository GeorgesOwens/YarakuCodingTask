<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Routing\Controller as BaseController;
use App\ViewModels\SearchViewModel;
use Illuminate\Support\Facades\Config;

class Controller extends BaseController
{
    public function Index(){

        return view('Pages.index');
    }

    public function Repository(){
        
        $books = $this->GetAllBooksOrderedAndPaginated();
        $viewModel = $this->CreateAndDefaultSearchViewModel(['Title'], 'title');

        return View('Pages.search')->with([
            'books'=> $books,
            'searchViewModel' => $viewModel
            ]);
    }

    public function AddBook(){
        
        return view('Pages.add');
    }

    public function Edit(Book $book){

        return view('Pages.edit')->with([
            'book' => $book, 
            'id' => $book->id
            ]);
    }

    private function GetAllBooksOrderedAndPaginated(){
        return Book::select('*')->orderBy('Title', 'asc')->paginate(Config::get('constants.BooksOnAPage'));
    }

    private function CreateAndDefaultSearchViewModel($defaultSearchByFields, $defaultOrderByField){
        
        $viewModel = new SearchViewModel();

        $viewModel->searchByFields = $defaultSearchByFields;
        $viewModel->orderByField = $defaultOrderByField;

        return $viewModel;
    }
}
