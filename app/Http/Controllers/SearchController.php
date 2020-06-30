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
        
        $csv = $this->ToCSV($books, $fieldsToExport);

        Storage::disk('local')->put('export.csv', $csv);

        return response()->download(storage_path('app/export.csv'), 'BookExport.csv');
    }

    private function ToCSV($models, $fields){

        $result = '';
        $csvRows = [];

        foreach($models as $model){

            $csvRows[] = $model->asCSV($fields)."\n";
        }
        
        $csvRows = array_unique($csvRows);

        foreach($csvRows as $csvRow){

            $result .= $csvRow;
        }

        return $result;
    }

    public function Search(Request $request)
    {
        $searchParameters = new SearchViewModel($request);
        $results = $this->GetPaginatedSearchResults($searchParameters, 7);

        return view('Pages.search')->with([
            'books' => $results,
            'searchViewModel' => $searchParameters
        ]);
    }

    private function GetPaginatedSearchResults(SearchViewModel $searchParameters, $pages){

        $search = $this->GetSearch($searchParameters);

        return $search->Paginate($pages);
    }

    private function GetSearchResults(SearchViewModel $searchParameters){

        $search = $this->GetSearch($searchParameters);

        return $search->get();
    }

    private function GetSearch(SearchViewModel $searchParameters)
    {
        $search = new SearchEngine(Book::class);

        if (isset($searchParameters->searchTerm)) {

            $search->SearchBy($searchParameters->searchByFields, $searchParameters->searchTerm);
        }

        $search->OrderBy($searchParameters->orderByField, $searchParameters->order);

        return $search;
    }
}
