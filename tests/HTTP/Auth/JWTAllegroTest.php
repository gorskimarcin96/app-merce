<?php

namespace App\Tests\HTTP\Auth;

use App\HTTP\Auth\JWTAllegro;
use App\HTTP\Factory\Request;
use App\HTTP\Factory\Uri;
use PHPUnit\Framework\TestCase;

class JWTAllegroTest extends TestCase
{
    public function testAuthRequest()
    {
        $JWTAllegro = new JWTAllegro('test_token');
        $requestFactory = new Request();
        $uriFactory = new Uri();
        $request = $requestFactory->createRequest('GET', $uriFactory->createUri('https://www.example.com'));
        $request = $JWTAllegro->authRequest($request);

        $this->assertSame([
            'Authorization: Bearer test_token',
            'Accept: application/vnd.allegro.public.v1+json'
        ], $request->getHeaders());
    }

    public function testGetPassword()
    {
        $JWTAllegro = new JWTAllegro('test_token');

        $this->assertSame('test_token', $JWTAllegro->getToken());
    }
}
