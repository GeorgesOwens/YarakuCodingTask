<?php

namespace App\Http\Controllers;

use App\CSVModelConverter;
use Illuminate\Http\Request;
use App\Models\Book;
use App\ViewModels\SearchViewModel;
use App\SearchEngine;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use UnexpectedValueException;

class SearchController extends Controller
{
    public function Export(Request $request)
    {
        $request->validate([
            'fieldsToExport' => 'array|min:1|required',
            'exportFormat' => 'required'
        ]);
        
        $searchParameters = new SearchViewModel($request);
        
        $modelConverter = $this
            ->GetModelConverter(
                $request->input('exportFormat'), 
                $this->GetSearchResults($searchParameters), 
                $request->input('fieldsToExport'));

        Storage::disk('local')->put('export.csv', $modelConverter->GetConvertedModels());

        return response()->download(storage_path('app/export.csv'), 'BookExport.csv');
    }

    private function GetModelConverter($format, $models, $fields){

        switch($format){
            case 'CSV': return new CSVModelConverter($models, $fields);
            default: throw new UnexpectedValueException();
        }
    }

    public function Search(Request $request)
    {
        $searchParameters = new SearchViewModel($request);
        $results = $this->GetPaginatedSearchResults($searchParameters, Config::get('constants.BooksOnAPage'));

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
