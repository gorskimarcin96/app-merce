<?php

namespace App\HTTP\Model;

use App\HTTP\Auth\AuthInterface;
use App\HTTP\CURL;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\HTTP\Factory\Response as ResponseFactory;
use App\HTTP\Factory\Stream as StreamFactory;

class Client implements ClientInterface
{
    private ResponseFactory $responseFactory;
    private StreamFactory $streamFactory;
    private ?AuthInterface $auth = null;

    public function __construct(private CURL $curl)
    {
        $this->responseFactory = new ResponseFactory();
        $this->streamFactory = new StreamFactory();
    }

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $request = $this->getAuth() ? $this->getAuth()->authRequest($request) : $request;

        $this->curl->execute([
            CURLOPT_URL => $request->getUri(),
            CURLOPT_CUSTOMREQUEST => $request->getMethod(),
            CURLOPT_POST => $request->getMethod() === 'POST',
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTPHEADER => $request->getHeaders(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $request->getBody()->getContents()
        ]);

        return $this->responseFactory
            ->createResponse($this->curl->getHttpCode())
            ->withBody($this->streamFactory->createStream($this->curl->getResult()));
    }

    public function getAuth(): ?AuthInterface
    {
        return $this->auth;
    }

    public function setAuth(?AuthInterface $auth): void
    {
        $this->auth = $auth;
    }
}