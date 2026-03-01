<?php

// Grab the user input
$userInput = readline("Enter the ISBN: ");

// Remove everything that isn't a number
$cleanedInput = preg_replace('/[^0-9]/', '', $userInput);

// Check to make sure we have 13 digits left - the size of an ISBN
if (strlen($cleanedInput) != 13) {
    echo "ISBN numbers are 13 digits, please reenter your number." . PHP_EOL;
} else {
    echo "You entered " . $cleanedInput . PHP_EOL;
}
