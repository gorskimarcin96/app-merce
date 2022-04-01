<?php

namespace App\HTTP\Model;

class HttpCode
{
    private int $code = 200;
    private string $reasonPhrase;

    public function getStatusCode(): int
    {
        return $this->code;
    }

    public function getReasonPhrase(): string
    {
        return $this->reasonPhrase;
    }

    public function withHttpCode(int $code, string $reasonPhrase): HttpCode|static
    {
        $this->code = $code;
        $this->reasonPhrase = $reasonPhrase;

        return $this;
    }
}