<?php

/**
 * Run the autoloader
 */
require __DIR__ . '/vendor/autoload.php';

use Library\IsbnValidator;
use Library\BookMetadata;
use Library\BookLedger;

$validator = new IsbnValidator();
$metadata = new BookMetadata();
$ledger = new BookLedger();

// Instruction block
echo "Welcome to The Library!" . PHP_EOL;
echo "To add a new book, please enter the 13 digit ISBN number." . PHP_EOL . PHP_EOL;
echo "To exit this applicaiton, enter the word 'exit' instead of a number." . PHP_EOL;

while (true) {
  // Grab the user input
  $userInput = readline("Enter the ISBN (or exit to quit): ");

  // Convert the input to lowercase and trim for the 'exit' check
  $normalizedInput = strtolower(trim($userInput));
  // Check to see if the user wants to exit
  if ($normalizedInput == "exit") {
    break;
  }

  try {
    $valid_check = $validator->isValidIsbn13($normalizedInput);
    $bookInfo = $metadata->getBook($valid_check);
    $ledger->writeBook($bookInfo);
    echo "Success! Your book has been added to the ledger." . PHP_EOL;
  } catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
  }
}
