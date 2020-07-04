<?php

namespace App\Http\Controllers;

use App\Services\CSVModelConverter;
use App\Services\XMLModelConverter;
use Illuminate\Http\Request;
use App\Models\Book;
use App\ViewModels\SearchViewModel;
use App\Services\SearchEngine;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use UnexpectedValueException;
use App\Interfaces\ISearchEngineService;

class SearchController extends Controller
{
    private ISearchEngineService $searchEngineService;

    public function __construct(ISearchEngineService $searchEngineService)
    {
        $this->searchEngineService = $searchEngineService;
    }

    public function Export(Request $request)
    {
        $request->validate([
            'fieldsToExport' => 'array|min:1|required',
            'exportFormat' => 'required'
        ]);
        
        $searchParameters = new SearchViewModel($request);
        $exportFormat = $request->input('exportFormat');

        $modelConverter = $this
            ->GetModelConverter(
                $exportFormat, 
                $this->searchEngineService->Search(Book::class, $searchParameters), 
                $request->input('fieldsToExport'));

        Storage::disk('local')->put('export.txt', $modelConverter->GetConvertedModels());

        return response()->download(storage_path('app/export.txt'), 'BookExport.'.strtolower($exportFormat));
    }

    private function GetModelConverter($format, $models, $fields){

        switch($format){
            case 'CSV': return new CSVModelConverter($models, $fields);
            case 'XML': return new XMLModelCOnverter($models, $fields);
            default: throw new UnexpectedValueException();
        }
    }

    public function Search(Request $request)
    {
        $searchParameters = new SearchViewModel($request);
        $results = $this->SearchForAndPaginateBooks($searchParameters);

        return view('Pages.search')->with([
            'books' => $results,
            'searchViewModel' => $searchParameters
        ]);
    }

    private function SearchForAndPaginateBooks($searchParameters){

        return $this->searchEngineService->SearchAndPaginate(Book::class, $searchParameters, Config::get('constants.BooksOnAPage'));
    }
}
