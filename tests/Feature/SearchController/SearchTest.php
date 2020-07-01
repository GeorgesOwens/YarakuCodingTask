<?php

namespace Tests\Feature\SearchController;

use App\ViewModels\SearchViewModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;
use Illuminate\Support\Facades\Config;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function returns_ok_and_view()
    {
        $this->call('GET', '/repository/search', $this->SearchRequest())
            ->assertOk()
            ->assertViewIs('Pages.search');
    }

    /** @test */
    public function returns_same_search_parameters()
    {
        $viewModel = $this->call('GET', '/repository/search', $this->SearchRequest())->viewData('searchViewModel');

        $this->assertEquals($this->RequestMatchingViewModel(), $viewModel);
    }

    /** @test */
    public function requires_at_leat_one_searchBy()
    {
        $response = $this->call('GET', '/repository/search', array_merge($this->SearchRequest(), ['searchBy' => '']));

        $response->assertSessionHasErrors('searchBy');
    }

    /** @test */
    public function returns_books_in_view_data()
    {
        factory(Book::class, 10)->create();

        $books = $this->call('GET', '/repository/search', $this->SearchRequest())
            ->assertViewHas('books')->viewData('books');

        $this->assertEquals(Book::class, get_class($books->first()));
    }

    /** @test */
    public function returns_paginated_amount()
    {
        factory(Book::class, 10)->create();

        $books = $this->call('GET', '/repository/search', $this->SearchRequest())->viewData('books');

        $this->assertCount(Config::get('constants.BooksOnAPage'), $books);
    }

    /** @test */
    public function doesnt_modify_database()
    {
        factory(Book::class, 10)->create();

        $books = Book::all();

        $response = $this->call('GET', '/repository/search', $this->SearchRequest());

        $this->assertEquals($books, Book::all());
    }

    /** @test */
    public function validates_test_cases()
    {
        $testCases = SearchTestCases::GetTestCases();
        SearchTestCases::MockBookRepository();

        foreach ($testCases as $testCase) {
            $bookIds = $this->call('GET', 'repository/search', $testCase['searchParameters'])->viewData('books')
                ->map(function ($book) {
                    return $book->id;
                })
                ->toArray();

            $this->assertEquals($testCase['expectedResults'], $bookIds);
        }
    }

    private function SearchRequest()
    {
        return [
            'searchTerm' => '',
            'searchBy' => ['title' => 'title'],
            'orderBy' => 'title',
            'order' => 'asc'
        ];
    }

    private function RequestMatchingViewModel()
    {
        $searchRequest = $this->SearchRequest();
        $viewModel = new SearchViewModel();
        $viewModel->searchTerm = $searchRequest['searchTerm'];
        $viewModel->searchByFields = $searchRequest['searchBy'];
        $viewModel->orderByField = $searchRequest['orderBy'];
        $viewModel->order = $searchRequest['order'];
        return $viewModel;
    }
}
