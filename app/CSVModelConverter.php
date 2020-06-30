<?php

namespace App;

class CSVModelConverter extends ModelConverter
{
    protected function Convert(): string
    {
        $result = '';
        $csvRows = [];

        foreach($this->models as $model){

            $csvRows[] = $model->asCSV($this->fields)."\n";
        }
        
        $csvRows = array_unique($csvRows);

        foreach($csvRows as $csvRow){

            $result .= $csvRow;
        }

        return $result;
    }
}