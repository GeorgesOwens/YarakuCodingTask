<?php

namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    /** @test */
    public function base_route_returns_200()
    {
        $this->get('/')
            ->assertOk();
    }

    /** @test */
    public function base_route_returns_index()
    {
        $this->get('/')
            ->assertViewIs('Pages.index');
    }
}
