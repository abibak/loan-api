<?php

namespace Tests;


class UserControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testAuthorizationMissingUser()
    {
        $response = $this->json('POST', 'api/login', [
            'email' => 'missingUser@mail.ru',
            'password' => 'pass123'
        ]);

        $response->assertResponseStatus(404);
    }

}
