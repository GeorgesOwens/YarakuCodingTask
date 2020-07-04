<?php
namespace App\Services;

use App\Interfaces\ISearchEngineService;
use App\ViewModels\SearchViewModel;

class SearchEngineService implements ISearchEngineService
{
    public function Search($modelType, SearchViewModel $searchParameters){

        $searchEngine = $this->GetSearchEngine($modelType, $searchParameters);

        return $searchEngine->get();
    }

    public function SearchAndPaginate($modelType, SearchViewModel $searchParameters, int $numberOfPages){
        
        $searchEngine = $this->GetSearchEngine($modelType, $searchParameters);

        return $searchEngine->Paginate($numberOfPages);
    }

    private function GetSearchEngine($modelType, SearchViewModel $searchParameters){
        
        $searchEngine = new SearchEngine($modelType);

        if(isset($searchParameters->searchTerm)){
            $searchEngine->SearchBy($searchParameters->searchByFields, $searchParameters->searchTerm);
        }

        $searchEngine->OrderBy($searchParameters->orderByField, $searchParameters->order);
        
        return $searchEngine;
    }
}