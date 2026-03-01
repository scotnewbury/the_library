<?php

require_once 'isbn_validator.php';

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
    
  // Remove everything that isn't a number
  $cleanedInput = preg_replace('/[^0-9]/', '', $normalizedInput);
  $inputLength = strlen($cleanedInput);

  // Check to make sure we have 13 digits left - the size of an ISBN
  if ($inputLength !== 13) {
    echo "Please remember, ISBN numbers are 13 digit numbers, please reenter your number." . PHP_EOL;
  } else {
    if (isValidIsbn13($cleanedInput)) {
        echo "Success: " . $cleanedInput . " is a valid ISBN-13." . PHP_EOL;
    } else {
        echo "Invalid: The digits are correct length, but it is not a valid ISBN-13." . PHP_EOL;
    }
  }
}
