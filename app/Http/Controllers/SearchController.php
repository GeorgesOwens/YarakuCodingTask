<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\ViewModels\SearchViewModel;
use App\SearchEngine;
use Illuminate\Support\Facades\Storage;

class SearchController extends Controller
{
    public function Export(Request $request)
    {
        $request->validate([
            'fieldsToExport' => 'array|min:1|required'
        ]);

        $searchParameters = new SearchViewModel($request);
        $fieldsToExport = $request->input('fieldsToExport');

        $books = $this->GetSearchResults($searchParameters);
        
        Storage::disk('local')->put('export.json', $books);

        return response()->download(storage_path('app/export.json'), 'BookExport.json');
    }

    public function Search(Request $request)
    {
        $searchParameters = new SearchViewModel($request);
        $results = $this->GetSearchResults($searchParameters);

        return view('Pages.search')->with([
            'books' => $results,
            'searchViewModel' => $searchParameters
        ]);
    }

    private function GetSearchResults(SearchViewModel $searchParameters)
    {
        $search = new SearchEngine(Book::class);

        if (isset($searchParameters->searchTerm)) {

            $search->SearchBy($searchParameters->searchByFields, $searchParameters->searchTerm);
        }

        $search->OrderBy($searchParameters->orderByField, $searchParameters->order);

        return $search->get();
    }
}
