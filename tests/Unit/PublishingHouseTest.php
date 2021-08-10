<?php

namespace Tests\Unit;

use Tests\TestCase;

class PublishingHouseTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetAllPublishingHouses()
    {
        $response = $this->get('book/publishing-house');
        $response
            ->assertStatus(200);
    }

    public function testGetOnePublishingHouseById()
    {
        $response = $this->get('book/publishing-house/1');
        $response
            ->assertStatus(200);
    }
}
