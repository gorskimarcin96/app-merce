<?php

namespace App\HTTP;

interface HTTPInterface
{
    public function get(string $url);

    public function post(string $url);

    public function put(string $url);

    public function patch(string $url);

    public function delete(string $url);
}