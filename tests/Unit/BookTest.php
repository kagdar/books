<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class BookTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetAllBooks()
    {
        $user = User::all()->first();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('book/books');
        $response
            ->assertStatus(200);
    }

    public function testGetOneBookById()
    {
        $user = User::all()->first();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('book/books/1');
        $response
            ->assertStatus(200);
    }

    public function testDeleteOneBookById()
    {
        $user = User::all()->first();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->delete('book/books/4');
        $response
            ->assertStatus(200);
    }

    public function testCreateNewBook()
    {
        $user = User::all()->first();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->postJson('book/books', [
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
        $user = User::all()->first();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->putJson('book/books/1', [
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
