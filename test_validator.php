<?php

require_once 'isbn_validator.php';

$test_conditions = [
  "9781603020220" => "Valid ISBN13",
  "123" => "Incorrect Length",
  "abc456" => "Incorrect Length",
  "abcdef" => "Incorrect Length",
  "" => "Incorrect Length",
  "12345678901234" => "Incorrect Length",
  "1234567890123" => "Checksum Incorrect"
];

foreach ($test_conditions as $key => $value) {
    // echo "$key\n";
    // echo "$value\n";
    $test_response = isValidIsbn13($key);

    if ($test_response == $value) {
      echo "Key: " . $key . " - " . $value . " PASS" . PHP_EOL;
    } else {
      echo "Key: " . $key . " - " . $value . " FAIL" . PHP_EOL;
    }
}