<?php

require_once 'src/isbn_validator.php';
require_once 'src/write_to_book_ledger.php';
require_once 'src/get_book_metadata.php';

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

  $valid_check = isValidIsbn13($normalizedInput);
  switch ($valid_check["status"]) {
    case "Incorrect Length":
      echo "Please remember, ISBN numbers are 13 digit numbers, please reenter your number." . PHP_EOL;
      break;
    case "Valid ISBN13":
      echo "Success: " . $valid_check["cleaned"] . " is a valid ISBN-13." . PHP_EOL;
      $bookInfo = getBookMetadata($valid_check['cleaned']);
      if (array_key_exists('status', $bookInfo)) {
        break;
      } else {
        writeToBookLedger($bookInfo);
        break;
      }
    case "Checksum Incorrect":
      echo "Invalid: The number of digits is correct, but it is not a valid ISBN-13." . PHP_EOL;
      break;
    default:
      echo "An unknown error has occurred." . PHP_EOL;
  }
}
