<?php

namespace Tests\Feature\SearchController;

use App\Models\Book;

class ExportTestCases{

    private const Books = [
        ['title' => 'Harry Potter and the Goblet of Fire', 'author' => 'J.K. Rowling'],
        ['title' => 'Harry Potter and the Philosopher\'s Stone', 'author' => 'J.K. Rowling'],
        ['title' => 'James and the Giant Peach', 'author' => 'Roald Dahl'],
        ['title' => 'Peter Pan', 'author' => 'James Matthews Barrie']
    ];

    public static function GetTestCases(){
        return [
            ['ExportRequest' => ['fieldsToExport' => ['Title', 'Author'], 'exportFormat' => 'CSV'],
            'ExpectedFile' => 'tests/TestFiles/Export/title_and_author_export.csv'],
            ['ExportRequest' => ['fieldsToExport' => ['Title'], 'exportFormat' => 'CSV'],
            'ExpectedFile' => 'tests/TestFiles/Export/title_only_export.csv'],
            ['ExportRequest' => ['fieldsToExport' => ['Author'], 'exportFormat' => 'CSV'],
            'ExpectedFile' => 'tests/TestFiles/Export/author_only_export.csv'],
            ['ExportRequest' => ['fieldsToExport' => ['Title', 'Author'], 'exportFormat' => 'XML'],
            'ExpectedFile' => 'tests/TestFiles/Export/title_and_author_export.xml'],
            ['ExportRequest' => ['fieldsToExport' => ['Title'], 'exportFormat' => 'XML'],
            'ExpectedFile' => 'tests/TestFiles/Export/title_only_export.xml'],
            ['ExportRequest' => ['fieldsToExport' => ['Author'], 'exportFormat' => 'XML'],
            'ExpectedFile' => 'tests/TestFiles/Export/author_only_export.xml']
        ];
    }

    public static function MockBookRepository(){

        foreach(Self::Books as $book){

            factory(Book::class)->create(['Title' => $book['title'], 'Author' => $book['author']]);
        }
    }
}