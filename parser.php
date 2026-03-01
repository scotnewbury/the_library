<?php

// Instruction block
echo "Welcome to The Library!" . PHP_EOL;
echo "To add a new book, please enter the 13 digit ISBN number." . PHP_EOL . PHP_EOL;
echo "To exit this applicaiton, enter the word 'exit' instead of a number." . PHP_EOL;

// Grab the user input
$userInput = readline("Enter the ISBN: ");

while ($userInput != "exit") {
  // Remove everything that isn't a number
  $cleanedInput = preg_replace('/[^0-9]/', '', $userInput);

  // Check to make sure we have 13 digits left - the size of an ISBN
  if (strlen($cleanedInput) != 13) {
      echo "Please remember, ISBN numbers are 13 digit numbers, please reenter your number." . PHP_EOL;
  } else {
      echo "You entered " . $cleanedInput . PHP_EOL;
  }
  // Grab the user input
  $userInput = readline("Enter the ISBN (or exit to quit): ");
}
