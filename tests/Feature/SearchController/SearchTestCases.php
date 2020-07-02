<?php

namespace Tests\Feature\SearchController;

use App\Models\Book;

class SearchTestCases{

    private const Books = [
        ['id' => 1, 'title' => 'aaa', 'author' => 'bdd'],
        ['id' => 2, 'title' => 'bbb', 'author' => 'acc'],
        ['id' => 3, 'title' => 'abb', 'author' => 'bee'],
        ['id' => 4, 'title' => 'bcc', 'author' => 'add']
    ];

    public static function GetTestCases(){
        return [
            ['searchParameters' => Self::GetSearchParameters('a', ['title' => 'title'], 'title', 'asc'),
            'expectedResults' => [1, 3]],
            ['searchParameters' => Self::GetSearchParameters('a', ['title' => 'title'], 'title', 'desc'),
            'expectedResults' => [3, 1]],
            ['searchParameters' => Self::GetSearchParameters('a', ['title' => 'title'], 'author', 'asc'),
            'expectedResults' => [1, 3]],
            ['searchParameters' => Self::GetSearchParameters('a', ['title' => 'title'], 'author', 'desc'),
            'expectedResults' => [3, 1]],
            ['searchParameters' => Self::GetSearchParameters('a', ['author' => 'author'], 'title', 'asc'),
            'expectedResults' => [2, 4]],
            ['searchParameters' => Self::GetSearchParameters('a', ['author' => 'author'], 'title', 'desc'),
            'expectedResults' => [4, 2]],
            ['searchParameters' => Self::GetSearchParameters('a', ['author' => 'author'], 'author', 'asc'),
            'expectedResults' => [2, 4]],
            ['searchParameters' => Self::GetSearchParameters('a', ['author' => 'author'], 'author', 'desc'),
            'expectedResults' => [4, 2]],
            ['searchParameters' => Self::GetSearchParameters('a', ['title' => 'title', 'author' => 'author'], 'title', 'asc'),
            'expectedResults' => [1, 3, 2, 4]],
            ['searchParameters' => Self::GetSearchParameters('a', ['title' => 'title', 'author' => 'author'], 'title', 'desc'),
            'expectedResults' => [4, 2, 3, 1]],
            ['searchParameters' => Self::GetSearchParameters('a', ['title' => 'title', 'author' => 'author'], 'author', 'asc'),
            'expectedResults' => [2, 4, 1, 3]],
            ['searchParameters' => Self::GetSearchParameters('a', ['title' => 'title', 'author' => 'author'], 'author', 'desc'),
            'expectedResults' => [3, 1, 4, 2]]
        ];
    }

    private static function GetSearchParameters($searchTerm, $searchBy, $orderBy, $order){
        return ['searchTerm' => $searchTerm, 'searchBy' => $searchBy, 'orderBy' => $orderBy, 'order' => $order];
    }

    public static function MockBookRepository(){

        foreach(Self::Books as $book){

            factory(Book::class)->create(['id' => $book['id'], 'Title' => $book['title'], 'Author' => $book['author']]);
        }
    }
}