<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

abstract class ModelConverter{

    protected $models;
    protected $fields;
    
    public function __construct($models, $fields){

        $this->models = $models;
        $this->fields = $fields;
    }

    protected abstract function Convert() : string;

    public function GetConvertedModels(){
        
        return $this->Convert();
    }

}