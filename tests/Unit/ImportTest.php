<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;
class ImportTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testImport()
    {
        $user = User::all()->first();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->postJson('book/import-json', [
            [
                'title' => 'testImport1',
                'author' => "Ivanov I",
                'publishing_house_title' => "Boo",
                'publishing_house_link' => "https://laravel.com/docs/8.x/validation",
                'isbn' => '111-222-333',
                'page_count' => 200
            ],
            [
                'title' => 'testImport2',
                'author' => "Ivanov I",
                'publishing_house_title' => "Boo",
                'publishing_house_link' => "https://laravel.com/docs/8.x/validation",
                'isbn' => '111-222-333',
                'page_count' => 200
            ],
        ]);
        $response
            ->assertStatus(200);
    }
}
