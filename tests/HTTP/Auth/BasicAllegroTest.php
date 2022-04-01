<?php

namespace App\Tests\HTTP\Auth;

use App\HTTP\Auth\BasicAllegro;
use App\HTTP\Auth\JWTAllegro;
use App\HTTP\Factory\Request;
use App\HTTP\Factory\Uri;
use PHPUnit\Framework\TestCase;

class BasicAllegroTest extends TestCase
{
    public function testAuthRequest()
    {
        $JWTAllegro = new BasicAllegro('user','password');
        $requestFactory = new Request();
        $uriFactory = new Uri();
        $request = $requestFactory->createRequest('GET', $uriFactory->createUri('https://www.example.com'));
        $request = $JWTAllegro->authRequest($request);

        $this->assertSame([
            'Authorization: Basic dXNlcjpwYXNzd29yZA==',
            'Content-Type: application/x-www-form-urlencoded'
        ], $request->getHeaders());
        $this->assertSame('client_id=user', $request->getBody()->getContents());
    }

    public function testGetUser()
    {
        $JWTAllegro = new BasicAllegro('user','password');

        $this->assertSame('user', $JWTAllegro->getUser());
    }

    public function testGetPassword()
    {
        $JWTAllegro = new BasicAllegro('user','password');

        $this->assertSame('password', $JWTAllegro->getPassword());
    }
}
