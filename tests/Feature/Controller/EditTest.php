<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;

class EditTest extends TestCase
{
    use RefreshDatabase;
    private $id = 1;

    protected function setUp(): void
    {
        parent::setUp();

        factory(Book::class)->create(['id' => $this->id]);        
    }

    /** @test */
    public function returns_ok()
    {
        $this->get('//edit/'.$this->id)
            ->assertOk();
    }

    /** @test */
    public function returns_edit_view()
    {
        $this->get('//edit/'.$this->id)
            ->assertViewIs('Pages.edit');
    }
    
    /** @test */
    public function returns_id()
    {
        $this->get('//edit/'.$this->id)
            ->assertViewHas('id', $this->id);
    }

    /** @test */
    public function returns_book_of_id()
    {
        $otherId = 2;
        $book = factory(Book::class)->create(['id'=>$otherId]);

        $this->get('//edit/'.$otherId)
            ->assertViewHas('book', $book);
    }
    
}
