<?php

require __DIR__ . '/../vendor/autoload.php';

use Library\BookLedger;
use PHPUnit\Framework\TestCase;

class BookLedgerTest extends TestCase
{

    public $filePath;
    public function testBookLedger(): void
    {
        $validator = new BookLedger($this->filePath);
        $bookInfo = [
            '9781615641482',
            "The complete idiot's guide to world history",
        ];
        $validator->writeBook($bookInfo);
        $fileContents = file_get_contents($this->filePath);
        $this->assertStringContainsString($bookInfo[1], $fileContents);
    }

    protected function setUp(): void
    {
        $this->filePath = tempnam(sys_get_temp_dir(), 'ledger_test_');
    }

    protected function tearDown(): void
    {
        if (file_exists($this->filePath)) {
            unlink($this->filePath);
        }
    }
}
