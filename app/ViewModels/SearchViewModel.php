<?php

namespace App\ViewModels;

use Illuminate\Http\Request;

class SearchViewModel{
    
    public function __construct(Request $request = null){
        
        if($request == null){
            return;
        }

        $request->validate([
            'searchBy' => 'array|min:1|required',
        ]);

        $this->searchTerm = $request->input('searchTerm') ?? null;
        $this->searchByFields = $request->input('searchBy') ?? null;
    }
}