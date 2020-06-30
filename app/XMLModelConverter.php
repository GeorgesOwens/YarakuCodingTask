<?php

namespace App;

class XMLModelConverter extends ModelConverter{

    protected function Convert(): string
    {
        $result = '<?xml version="1.0" encoding="UTF-8"?>'."\n".'<root>'."\n";

        foreach($this->models as $model){
            $result .= '<element>'."\n";

            foreach($this->fields as $field){
                $result .= '<'.$field.'>'.$model->$field.'</'.$field.'>'."\n";
            }

            $result .= '</element>'."\n";
        }

        $result .= '</root>'."\n";

        return $result;
    }
}