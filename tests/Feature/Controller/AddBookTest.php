<?php

namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddBookTest extends TestCase
{
    /** @test */
    public function add_book_returns_200()
    {
        $this->get('/add')
            ->assertOk();
    }

    /** @test */
    public function add_book_returns_add_view()
    {
        $this->get('/add')
            ->assertViewIs('Pages.add');
    }
}
