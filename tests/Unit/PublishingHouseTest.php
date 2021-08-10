<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class PublishingHouseTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetAllPublishingHouses()
    {
        $user = User::all()->first();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('book/publishing-house');
        $response
            ->assertStatus(200);
    }

    public function testGetOnePublishingHouseById()
    {
        $user = User::all()->first();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->get('book/publishing-house/1');
        $response
            ->assertStatus(200);
    }
}
