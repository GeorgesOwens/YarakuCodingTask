<?php

namespace Tests\Feature\BookController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;


class StoreTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function redirects_to_add_form_with_success()
    {
        $response = $this->post('/book/Add', $this->BookData())->assertRedirect('/add');
        $response->assertSessionHas('success');
    }
    
    /** @test */
    public function creates_a_new_book()
    {
        $this->post('book/Add', $this->BookData());

        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function requires_title()
    {
        $response = $this->post('book/Add', array_merge($this->BookData(), ['Title' => '']));

        $response->assertSessionHasErrors('Title');
        $this->assertCount(0, Book::all());
    }
    
    /** @test */
    public function requires_author()
    {
        $response = $this->post('book/Add', array_merge($this->BookData(), ['Author' => '']));

        $response->assertSessionHasErrors('Author');
        $this->assertCount(0, Book::all());
    }
    
    public function BookData(){
        return ['Title' => 'TestTitle', 'Author' => 'TestAuthor'];
    }

}
