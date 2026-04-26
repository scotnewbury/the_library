<?php

require __DIR__ . '/../vendor/autoload.php';

use Library\BookMetadata;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class BookMetadataTest extends TestCase
{
    public function testBookMetadata(): void
    {
        $libraryResponse = new MockHandler([
            new Response(200, [], '{"numFound": 1, "docs": [{"title": "The Complete Idiot\'s Guide to World History"}]}')
        ]);

        $handlerStack = HandlerStack::create($libraryResponse);
        $libraryClient = new Client(['handler' => $handlerStack]);

        $testLibrary = new BookMetadata($libraryClient);
        $testResponse = $testLibrary->getBook(123);
        $this->assertStringContainsString("The Complete Idiot's Guide to World History", $testResponse['title']);
    }
}
