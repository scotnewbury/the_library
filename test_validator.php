<?php

require_once 'isbn_validator.php';

$test_conditions = [
  "9781603020220" => "Valid ISBN13",
];

foreach ($test_conditions as $key => $value) {
    echo "$key\n";
    echo "$value\n";
    $test_response = isValidIsbn13($key);

    if ($test_response == $value) {
      echo "Value is correct";
    } else {
      echo "Value is incorrect";
    }
}