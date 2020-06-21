<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function Index(){
        return view('Pages.index');
    }

    public function Search(){
        return view('Pages.search');
    }

    public function AddBook(){
        return view('Pages.add');
    }
}
