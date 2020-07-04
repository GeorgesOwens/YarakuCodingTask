<?php

namespace App\Services;

class XMLModelConverter extends ModelConverter{

    protected function Convert(): string
    {
        $result = '<?xml version="1.0" encoding="UTF-8"?>'."\n".'<root>'."\n";

        $xmlElements = [];
        foreach($this->models as $model){
            
            $xmlElement = '<element>'."\n";

            foreach($this->fields as $field){
                $xmlElement .= '<'.$field.'>'.$model->$field.'</'.$field.'>'."\n";
            }

            $xmlElement .= '</element>'."\n";

            $xmlElements[] = $xmlElement;
        }

        $xmlElements = array_unique($xmlElements);

        foreach($xmlElements as $xmlElement){
            $result .= $xmlElement;
        }

        $result .= '</root>'."\n";

        return $result;
    }
}