<?php

namespace App\Interfaces;

interface IModelConverterService{

    function ExportModelsToFile(string $format, $models, $fieldsToExport);
}