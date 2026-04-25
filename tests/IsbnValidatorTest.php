<?php

require __DIR__ . '/../vendor/autoload.php';
use Library\IsbnValidator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class IsbnValidatorTest extends TestCase
{
    public static function isbnProvider(): array
    {
      return [
        ['9781603020220'],
        ['9 781603 020220'],
        ['9-781603-020220'],
      ];
    }

    #[DataProvider('isbnProvider')]
    public function testValidIsbn($isbn): void
    {
        $validator = new IsbnValidator();
        $result = $validator->isValidIsbn13($isbn);
        $this->assertEquals('9781603020220', $result);
    }

    public static function lengthProvider(): array
    {
      return [
        ['123'],
        ['abc456'],
        ['DEF789'],
        ['abcdef'],
        [''],
        ['12345678901234'],
      ];
    }

    #[DataProvider('lengthProvider')]
    public function testWrongLength($isbn): void
    {
      $validator = new IsbnValidator();
      $this->expectException(\Exception::class);
      $this->expectExceptionMessage('The entry is not the correct length.');
      $validator->isValidIsbn13($isbn);
    }

    public function testChecksum(): void
    {
      $validator = new IsbnValidator();
      $this->expectException(\Exception::class);
      $this->expectExceptionMessage('The checksum is incorrect.');
      $validator->isValidIsbn13('1234567890123');
    }
}