<?php

namespace App\ViewModels;

use Illuminate\Http\Request;

class SearchViewModel{
    
    public $searchTerm = '';
    public $searchByFields = [];
    public $orderByField = '';
    public $order = 'asc';

    public function __construct(Request $request = null){
        
        if($request == null){
            return;
        }

        $this->Validate($request);

        $this->searchTerm = $request->input('searchTerm') ?? null;
        $this->searchByFields = $request->input('searchBy') ?? null;
        $this->orderByField = $request->input('orderBy') ?? null;
        $this->order = $request->input('order') ?? null;
        
    }

    private function Validate(Request $request){
        $request->validate([
            'searchBy' => 'array|min:1|required',
        ]);
    }

    public function HasSearchByField($searchByField) : bool
    {
        return isset($this->searchByFields[$searchByField]);
    }
}