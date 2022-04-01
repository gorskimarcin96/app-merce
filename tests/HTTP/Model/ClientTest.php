<?php

namespace App\Tests\HTTP\Model;

use App\Faker\Invoker;
use App\HTTP\Auth\JWTAllegro;
use App\HTTP\CURL;
use App\HTTP\Factory\Request;
use App\HTTP\Factory\Uri;
use App\HTTP\Model\Client;
use App\HTTP\Model\Response;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    use Invoker;

    public function testSendRequest()
    {
        $requestFactory = new Request();
        $uriFactory = new Uri();
        $request = $requestFactory->createRequest('GET', $uriFactory->createUri('https://www.example.com'));

        $curl = $this->createMock(CURL::class);
        $curl
            ->expects($this->once())
            ->method('getResult')
            ->willReturn('{"success":true}');
        $curl
            ->expects($this->once())
            ->method('getHttpCode')
            ->willReturn(200);

        $client = new Client($curl);
        $response = $client->sendRequest($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame('{"success":true}', $response->getBody()->getContents());
    }

    public function testGetAuth()
    {
        $client = new Client(new CURL());

        $this->assertSame(null, $client->getAuth());
    }

    public function testSetAuth()
    {
        $client = new Client(new CURL());
        $this->invokeProperties($client, ['auth' => new JWTAllegro('test')]);

        $this->assertInstanceOf(JWTAllegro::class, $client->getAuth());
    }
}
