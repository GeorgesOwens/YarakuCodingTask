<?php

namespace App\Interfaces;

use App\ViewModels\SearchViewModel;

interface ISearchEngineService{
    
    function Search($modelType, SearchViewModel $searchParameters);

    function SearchAndPaginate($modelType, SearchViewModel $searchParameters, int $numberOfPages);
}