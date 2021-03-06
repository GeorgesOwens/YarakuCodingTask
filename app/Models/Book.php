<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['Title', 'Author', 'Genre'];

    public const FormValidationRules = [
            'Title' => 'required',
            'Author' => 'required'
        ];

    private const AttributeMeta = [
            ['attribute' => 'Title', 
                'Metadata' => ['Searchable', 'Orderable', 'Exportable', 'Initialisable', 'Editable']],
            ['attribute' => 'Author', 
                'Metadata' => ['Searchable', 'Orderable', 'Exportable', 'Initialisable', 'Editable']],
            ['attribute' => 'Genre', 
                'Metadata' => ['Searchable', 'Orderable', 'Exportable', 'Initialisable', 'Editable']]
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
}
