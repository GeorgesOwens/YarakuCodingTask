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
        $csvRows = $this->ConvertModelsIntoCSVRows($models);
        
        $csvRows = array_unique($csvRows);

        foreach($csvRows as $csvRow){

            $result .= $csvRow;
        }

        return $result;
    }

    private function ConvertModelsIntoCSVRows($models){
        
        $csvRows = [];

        foreach($models as $model){

            $csvRows[] = $this->ConvertModelIntoCSVRow($model);
        }

        return $csvRows;
    }

    private function ConvertModelIntoCSVRow($model){

        $csvRow = '';

        foreach($this->fields as $field){

            $csvRow .= $model->$field.',';
        }

        $csvRow = trim($csvRow, ',');

        return $csvRow."\n";
    }
}