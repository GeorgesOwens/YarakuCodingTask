<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public const searchByFields = ['Title', 'Author'];
    public const orderByFields = ['Title'=>'Title', 'Author'=>'Author'];
    public const exportable = ['Title', 'Author'];

    public function asCSV($fields){

        $result = '';
        foreach($fields as $field){

            $result .= $this->$field.',';
        }
        return trim($result, ',');
    }
}
