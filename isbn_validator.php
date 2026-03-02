<?php
/**
 * isbn_validator.php
 * Contains logic for validating ISBN numbers.
 */

function cleanIsbn($input) {
    return preg_replace('/[^0-9X]/i', '', $input);
}

function isValidIsbn13(string $isbn) {
    if (strlen($isbn) !== 13) {
      return "Incorrect Length";
    }

    $sum = 0;
    for ($i = 0; $i < 12; $i++) {
        $sum += (int)$isbn[$i] * ($i % 2 === 0 ? 1 : 3);
    }

    $checkDigit = (10 - ($sum % 10)) % 10;
    if ($checkDigit === (int)$isbn[12]) {
      return "Valid ISBN13";
    } else {
      return "Checksum incorrect";
    }

    // return $checkDigit === (int)$isbn[12];
}