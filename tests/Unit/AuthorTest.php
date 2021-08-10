<?php

namespace Tests\Unit;

use Tests\TestCase;

class AuthorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function testGetAllAuthors()
    {
        $response = $this->get('book/author');
        $response
            ->assertStatus(200);
    }

    public function testGetOneAuthorById()
    {
        $response = $this->get('book/author/1');
        $response
            ->assertStatus(200);
    }
}
