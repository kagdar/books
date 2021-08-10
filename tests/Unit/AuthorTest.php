<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthorTest extends TestCase
{

    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function testGetAllAuthors()
    {
        $user = User::all()->first();
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('book/author');
        $response
            ->assertStatus(200);
    }

    public function testGetOneAuthorById()
    {
        $user = User::all()->first();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('book/author/1');
        $response
            ->assertStatus(200);
    }
}
