<?php

namespace Tests\Unit;

use Tests\TestCase;

class BookTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetAllBooks()
    {
        $response = $this->get('book/books');
        $response
            ->assertStatus(200);
    }

    public function testGetOneBookById()
    {
        $response = $this->get('book/books/1');
        $response
            ->assertStatus(200);
    }

    public function testDeleteOneBookById()
    {
        $response = $this->delete('book/books/4');
        $response
            ->assertStatus(200);
    }

    public function testCreateNewBook()
    {
        $response = $this->postJson('book/books', [
            'title' => 'test1',
            'author_id' => 1,
            'publishing_house_id' => 2,
            'isbn' => '111-222-333',
            'page_count' => 200
        ]);
        $response
            ->assertStatus(200);
    }

    public function testUpdateBook()
    {
        $response = $this->putJson('book/books/1', [
            'title' => 'testUpdate',
            'author_id' => 1,
            'publishing_house_id' => 2,
            'isbn' => '111-222-333',
            'page_count' => 200
        ]);
        $response
            ->assertStatus(200);
    }
}
