<?php

/**
 * IsbnValidator.php
 * Contains logic for validating ISBN numbers.
 */

namespace Library;

class IsbnValidator
{
    private function cleanIsbn($input)
    {
        return preg_replace('/[^0-9X]/i', '', $input);
    }

    public function isValidIsbn13(string $input)
    {

        $isbn = $this->cleanIsbn($input);

        if (strlen($isbn) !== 13) {
            throw new \Exception("The entry is not the correct length.");
        }

        $sum = 0;
        for ($i = 0; $i < 12; $i++) {
            $sum += (int)$isbn[$i] * ($i % 2 === 0 ? 1 : 3);
        }

        $checkDigit = (10 - ($sum % 10)) % 10;
        if ($checkDigit === (int)$isbn[12]) {
            return $isbn;
        } else {
            throw new \Exception("The checksum is incorrect.");
        }
    }
}
