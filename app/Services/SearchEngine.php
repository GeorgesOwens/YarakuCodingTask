<?php

namespace App\Services;

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

    public function Paginate($pages){

        return $this->query->paginate($pages);
    }

    public function get()
    {
        return $this->query->get();
    }
}
