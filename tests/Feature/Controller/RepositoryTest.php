<?php

namespace Tests\Feature\Controller;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Config;

class RepositoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function repository_returns_ok()
    {
        $this->get('/repository')
            ->assertOk();
    }
    
    /** @test */
    public function repository_returns_search_page()
    {
        $this->get('/repository')
            ->assertViewIs('Pages.search');
    }

    /** @test */
    public function repository_returns_books()
    {
        factory(Book::class)->create();

        $response = $this->get('/repository');
        $response->assertViewHas('books');
    }

    /** @test */
    public function repository_returns_empty_array_of_books_if_database_empty()
    {
        $books = $this->get('/repository')->viewData('books');
        $this->assertEquals($books->count(), 0);
    }
    
    /** @test */
    public function repository_returns_all_books_is_there_are_less_that_paginated_amount()
    {
        $numberOfBooks = Config::get('constants.BooksOnAPage') - 1;

        factory(Book::class, $numberOfBooks)->create();

        $books = $this->get('/repository')->viewData('books');
        $this->assertEquals($books->count(), $numberOfBooks);
    }

    /** @test */
    public function repository_returns_one_page_of_books_is_there_are_more_that_paginated_amount()
    {
        $numberOfBooks = Config::get('constants.BooksOnAPage') + 1;

        factory(Book::class, $numberOfBooks)->create();

        $books = $this->get('/repository')->viewData('books');
        $this->assertEquals($books->count(), Config::get('constants.BooksOnAPage'));
    }
    
    /** @test */
    public function repository_returns_a_search_view_model()
    {
        $this->get('/repository')
            ->assertViewHas('searchViewModel');
    }
    
}
