<?php

namespace App\Tests\HTTP\Factory;

use App\HTTP\Factory\Stream;
use App\HTTP\Factory\UploadedFile;
use App\HTTP\Model\UploadedFile as Model;
use PHPUnit\Framework\TestCase;

class UploadedFileTest extends TestCase
{
    public function testCreateUploadedFile()
    {
        $uploadedFileFactory=new UploadedFile();
        $streamFactory=new Stream();
        $uploadedFile = $uploadedFileFactory->createUploadedFile($streamFactory->createStream());

        $this->assertInstanceOf(Model::class, $uploadedFile);
    }
}
