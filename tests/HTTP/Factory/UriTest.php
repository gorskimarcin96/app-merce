<?php

namespace App\Tests\HTTP\Factory;

use App\HTTP\Factory\Uri;
use App\HTTP\Model\Uri as Model;
use PHPUnit\Framework\TestCase;

class UriTest extends TestCase
{
    public function testCreateUri()
    {
        $uriFactory = new Uri();
        $uri = $uriFactory->createUri('https://www.example.com');

        $this->assertInstanceOf(Model::class, $uri);
        $this->assertSame('https://www.example.com', $uri->__toString());
    }
}
