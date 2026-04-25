<?php

require __DIR__ . '/../vendor/autoload.php';
use Library\IsbnValidator;
 use PHPUnit\Framework\TestCase;

class IsbnValidatorTest extends TestCase
{
    public function testValidIsbn(): void
    {
        $validator = new IsbnValidator();
        $result = $validator->isValidIsbn13('9781603020220');
        $this->assertEquals('9781603020220', $result);
    }

    public function testWrongLength(): void
    {
      $validator = new IsbnValidator();
      $this->expectException(\Exception::class);
      $this->expectExceptionMessage('The entry is not the correct length.');
      $validator->isValidIsbn13('123');
    }

    public function testChecksum(): void
    {
      $validator = new IsbnValidator();
      $this->expectException(\Exception::class);
      $this->expectExceptionMessage('The checksum is incorrect.');
      $validator->isValidIsbn13('1234567890123');
    }
}