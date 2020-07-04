<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

abstract class ModelConverter{

    protected $fields;

    public abstract function GetExtension();
    
    protected abstract function Convert($models) : string;

    public function SetFieldsToBeConverted($fields){
        $this->fields = $fields;
    }

    public function GetConvertedModels($models){
        
        if(empty($this->fields)){
            return '';
        }

        return $this->Convert($models);
    }
}