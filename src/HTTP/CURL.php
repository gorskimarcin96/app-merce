<?php

namespace App\HTTP;

class CURL
{
    private int $httpCode;
    private string $result;

    public function execute(array $curlOptions = []): void
    {
        $ch = curl_init();

        curl_setopt_array($ch, $curlOptions);

        if (!$result = curl_exec($ch)) {
            trigger_error(curl_error($ch));
        }

        $this->httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        $this->result = $result;
    }

    public function getHttpCode(): int
    {
        return $this->httpCode;
    }

    public function getResult(): string
    {
        return $this->result;
    }
}