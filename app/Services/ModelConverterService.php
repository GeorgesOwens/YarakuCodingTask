<?php

namespace App\Services;

use App\Interfaces\IModelConverterService;
use Illuminate\Support\Facades\Storage;
use UnexpectedValueException;

class ModelConverterService implements IModelConverterService
{
    
    public function ExportModelsToFile(string $format, $models, $fieldsToExport){

        $converter = $this->GetConverter($format);

        $converter->SetFieldsToBeConverted($fieldsToExport);

        $convertedModels = $converter->GetConvertedModels($models);

        $fileName = 'export'.$converter->GetExtension();

        Storage::disk('local')->put($fileName, $convertedModels);

        return $fileName;
    }

    private function GetConverter($format){

        switch($format){
            case 'CSV': return new CSVModelConverter();
            case 'XML': return new XMLModelConverter();
            default: throw new UnexpectedValueException();
        }
    }
}