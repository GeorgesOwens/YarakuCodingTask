<?php

namespace Tests\Feature\BookController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;

class RemoveTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function redirects_to_reposiory_with_success()
    {
        $id = 1;
        factory(Book::class)->create(['id' => $id]);

        $this->post('book/remove/'.$id)
            ->assertRedirect('/repository')
            ->assertSessionHas('success');
    }

    /** @test */
    public function removes_book()
    {
        $id = 1;
        factory(Book::class)->create(['id' => $id]);

        $this->post('book/remove/'.$id);

        $this->assertNull(Book::find($id));
    }

    
}
