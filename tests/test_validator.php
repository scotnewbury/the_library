<?php

require __DIR__ . '/../vendor/autoload.php';
use Library\IsbnValidator;
$validator = new IsbnValidator();

// ANSI Escape Constants
const BG_PASS  = "\e[1;37;42m"; // Bold White on Green
const BG_FAIL  = "\e[1;37;41m"; // Bold White on Red
const CLR_RESET = "\e[0m";      // Reset the color coding

$test_conditions = [
  '9781603020220' => '9781603020220',
  '9 781603 020220' => '9781603020220',
  '9-781603-020220' => '9781603020220',
  '123' => 'The entry is not the correct length.',
  'abc456' => 'The entry is not the correct length.',
  'abcdef' => 'The entry is not the correct length.',
  '' => 'The entry is not the correct length.',
  '12345678901234' => 'The entry is not the correct length.',
  '1234567890123' => 'The checksum is incorrect.'
];

// Print the header
printf("\n %-20s %-40s %-10s\n", "TEST VALUE", "RESPONSE", "RESULT");
echo str_repeat("-", 75) . PHP_EOL;

foreach ($test_conditions as $key => $value) {
    $test_response = "";

    try {
      $test_response = $validator->isValidIsbn13($key);
    } catch (\Exception $e) {
      $test_response = $e ->getMessage();
    } 
    
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
    printf("%-20s %-40s %s\n", $key, $value, $badge);
}
