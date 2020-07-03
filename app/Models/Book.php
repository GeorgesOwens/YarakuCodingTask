<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['Title', 'Author'];

    public const FormValidationRules = [
            'Title' => 'required',
            'Author' => 'required'
        ];

    private const AttributeMeta = [
            ['attribute' => 'Title', 'Metadata' => ['Searchable', 'Orderable', 'Exportable']],
            ['attribute' => 'Author', 'Metadata' => ['Searchable', 'Orderable', 'Exportable']]
        ];
    
    public static function GetFieldsWithMeta($meta){

        return collect(Self::AttributeMeta)
            ->filter(function($value) use ($meta){
                return in_array($meta, $value['Metadata']);
            })
            ->map(function($item){
                return $item['attribute'];
            });
    }

    public function asCSV($fields){

        $result = '';
        foreach($fields as $field){

            $result .= $this->$field.',';
        }
        return trim($result, ',');
    }
}
