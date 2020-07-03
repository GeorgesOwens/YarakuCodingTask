<?php

namespace Tests\Feature\BookController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;

class UpdateTest extends TestCase
{
    use RefreshDatabase;
    
    private $id = 1;
    
    protected function setUp(): void
    {
        parent::setUp();

        factory(Book::class)->create(['id' => $this->id]);
    }
    

    /** @test */
    public function redirects_to_repository_with_success()
    {
        $this->post('book/update/'.$this->id, $this->BookData())
            ->assertRedirect('/repository')
            ->assertSessionHas('success');
    }

    /** @test */
    public function only_updates_book_title()
    {
        $newTitle = 'NewTitle';

        $this->post('book/update/'.$this->id, array_merge($this->BookData(), ['Title' => $newTitle]));

        $book = Book::find($this->id);

        $this->assertEquals($book->Title, $newTitle);
        $this->assertEquals($book->Author, $this->BookData()['Author']);
    }

    /** @test */
    public function only_updates_book_author()
    {
        $newAuthor = 'NewAuthor';

        $this->post('book/update/'.$this->id, array_merge($this->BookData(), ['Author' => $newAuthor]));

        $book = Book::find($this->id);
        $this->assertEquals($book->Author, $newAuthor);
        $this->assertEquals($book->Title, $this->BookData()['Title']);
    }
    
    /** @test */
    public function updates_both_book_fields()
    {
        $newTitle = 'NewTitle';
        $newAuthor = 'NewAuthor';

        $this->post('book/update/'.$this->id, array_merge($this->BookData(), ['Title' => $newTitle, 'Author' => $newAuthor]));

        $book = Book::find($this->id);

        $this->assertEquals($book->Author, $newAuthor);
        $this->assertEquals($book->Title, $newTitle);
    }

    /** @test */
    public function update_requires_title()
    {
        $request = $this->post('book/update/'.$this->id, array_merge($this->BookData(), ['Title' => '']));
        
        $request->assertSessionHasErrors('Title');
        
        $book = Book::find($this->id);
        $this->assertEquals($book->Author, $this->BookData()['Author']);
        $this->assertEquals($book->Title, $this->BookData()['Title']);
    }

    public function update_requires_author()
    {
        $request = $this->post('book/update/'.$this->id, array_merge($this->BookData(), ['Author' => '']));
        
        $request->assertSessionHasErrors('Title');
        
        $book = Book::find($this->id);
        $this->assertEquals($book->Author, $this->BookData()['Author']);
        $this->assertEquals($book->Title, $this->BookData()['Title']);
    }
    

    public function BookData(){
        $book = Book::find($this->id);
        return ['Title' => $book->Title, 'Author' => $book->Author];
    }
}
