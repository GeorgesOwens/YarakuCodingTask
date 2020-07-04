<?php

namespace App\Services;

class XMLModelConverter extends ModelConverter{

    private const extension = '.xml';

    public function GetExtension(){
        return Self::extension;
    }

    protected function Convert($models): string
    {
        $result = '<?xml version="1.0" encoding="UTF-8"?>'."\n".'<root>'."\n";

        $xmlElements = [];
        foreach($models as $model){
            
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