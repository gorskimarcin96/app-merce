<?php

namespace App\HTTP;

use App\HTTP\Auth\AuthInterface;
use App\HTTP\Factory\Request as RequestFactory;
use App\HTTP\Factory\Stream as StreamFactory;
use App\HTTP\Factory\Uri as UriFactory;
use App\HTTP\Model\Client;
use Psr\Http\Message\ResponseInterface;

class HTTP implements HTTPInterface, HTTPMethodsInterface
{
    private RequestFactory $requestFactory;
    private UriFactory $uriFactory;
    private Client $client;

    public function __construct()
    {
        $this->requestFactory = new RequestFactory();
        $this->uriFactory = new UriFactory();
        $this->client = new Client(new CURL());
    }

    public function setAuth(AuthInterface $auth)
    {
        $this->client->setAuth($auth);
    }

    public function get(string $url, string $data = '', array $headers = []): ResponseInterface
    {
        return $this->request($url, self::GET, $data, $headers);
    }

    public function post(string $url, string $data = '', array $headers = []): ResponseInterface
    {
        return $this->request($url, self::POST, $data, $headers);
    }

    public function put(string $url, string $data = '', array $headers = []): ResponseInterface
    {
        return $this->request($url, self::PUT, $data, $headers);
    }

    public function patch(string $url, string $data = '', array $headers = []): ResponseInterface
    {
        return $this->request($url, self::PATCH, $data, $headers);
    }

    public function delete(string $url, string $data = '', array $headers = []): ResponseInterface
    {
        return $this->request($url, self::DELETE, $data, $headers);
    }

    private function request(string $url, string $method, string $data = '', array $headers = []): ResponseInterface
    {
        $request = $this->requestFactory
            ->createRequest($method, $this->uriFactory->createUri($url))
            ->withBody((new StreamFactory())->createStream($data));

        foreach ($headers as $index => $header) {
            $request = $request->withAddedHeader($index, $header);
        }

        return $this->client->sendRequest($request);
    }
}