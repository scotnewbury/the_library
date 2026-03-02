<?php

require_once 'isbn_validator.php';

// ANSI Escape Constants
const BG_PASS  = "\e[1;37;42m"; // Bold White on Green
const BG_FAIL  = "\e[1;37;41m"; // Bold White on Red
const CLR_RESET = "\e[0m";      // Reset the color coding

$test_conditions = [
  "9781603020220" => "Valid ISBN13",
  "9 781603 020220" => "Valid ISBN13",
  "9-781603-020220" => "Valid ISBN13",
  "123" => "Incorrect Length",
  "abc456" => "Incorrect Length",
  "abcdef" => "Incorrect Length",
  "" => "Incorrect Length",
  "12345678901234" => "Incorrect Length",
  "1234567890123" => "Checksum Incorrect"
];

// Print the header
printf("%-20s %-20s %-10s\n", "TEST VALUE", "RESPONSE", "RESULT");
echo str_repeat("-", 55) . PHP_EOL;

foreach ($test_conditions as $key => $value) {
    $test_response = isValidIsbn13($key);
    
    if ($test_response == $value) {
      $status = " PASS ";
      $style  = BG_PASS;
    } else {
      $status = " FAIL ";
      $style  = BG_FAIL;
    }
 
    // Center the status string inside a 12 character width
    $padded_status = str_pad($status, 12, " ", STR_PAD_BOTH);

    // Wrap the style around the padded string
    $badge = $style . $padded_status . CLR_RESET; // NOTE: reset color afterwards

    // Print the resulting row
    printf("%-20s %-20s %s\n", $key, $value, $badge);
}
