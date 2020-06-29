<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\ViewModels\SearchViewModel;
use App\SearchEngine;

class SearchController extends Controller
{
    public function Search(Request $request)
    {
        $searchParameters = new SearchViewModel($request);
        $search = new SearchEngine(Book::class);

        if (isset($searchParameters->searchTerm)) {

            $search->SearchBy($searchParameters->searchByField, $searchParameters->searchTerm);
        }

        return view('Pages.search')->with([
            'books' => $search->get(),
            'searchByFields' => Book::searchByFields,
            'searchViewModel' => $searchParameters
        ]);
    }
}
