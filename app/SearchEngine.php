<?php

namespace App;

class SearchEngine
{
    private $modelType;
    private $query;

    public function __construct($modelType)
    {
        $this->modelType = $modelType;
        $this->query = $this->modelType::select('*');
    }

    public function SearchBy($fields, $term)
    {
        foreach ($fields as $field) {

            $this->query->orWhere($field, 'LIKE', '%' . $term . '%');
        }
    }

    public function OrderBy($field, $order = 'asc')
    {
        $this->query->orderBy($field, $order);
    }

    public function get()
    {
        return $this->query->get();
    }
}
