<?php

namespace App\Services;

class CSVModelConverter extends ModelConverter
{
    private const extension = '.csv';

    public function GetExtension(){
        return Self::extension;
    }

    protected function Convert($models): string
    {
        $result = '';
        $csvRows = [];

        foreach($models as $model){

            $csvRows[] = $model->asCSV($this->fields)."\n";
        }
        
        $csvRows = array_unique($csvRows);

        foreach($csvRows as $csvRow){

            $result .= $csvRow;
        }

        return $result;
    }
}