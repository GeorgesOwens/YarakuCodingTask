<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\ViewModels\SearchViewModel;
use Illuminate\Support\Facades\Config;
use App\Interfaces\ISearchEngineService;
use App\Interfaces\IModelConverterService;

class SearchController extends Controller
{
    private ISearchEngineService $searchEngineService;
    private IModelConverterService $modelConverterService;

    public function __construct(ISearchEngineService $searchEngineService, IModelConverterService $modelConverterService)
    {
        $this->searchEngineService = $searchEngineService;
        $this->modelConverterService = $modelConverterService;
    }

    public function Export(Request $request)
    {
        $this->ValidateExportRequest($request);
        
        $fileName = $this->SearchForAndExportModelsToFile($request);

        return response()->download(storage_path('app/'.$fileName));
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

    private function SearchForAndExportModelsToFile($request){

        $exportFormat = $request->input('exportFormat');
        $fieldsToExport = $request->input('fieldsToExport');
        $searchResults = $this->searchEngineService->Search(Book::class, new SearchViewModel($request));
        
        return $this->modelConverterService->ExportModelsToFile($exportFormat, $searchResults, $fieldsToExport);
    }

    private function ValidateExportRequest($request){
        
        $request->validate([
            'fieldsToExport' => 'array|min:1|required',
            'exportFormat' => 'required'
        ]);
    }
}
