<?php
$userInput = readline("Enter the ISBN: ");
$cleanedInput = preg_replace('/[^0-9]/', '', $userInput);
if (strlen($cleanedInput) != 13) {
    echo "ISBN numbers are 13 digits, please reenter your number." . PHP_EOL;
} else {
    echo "You entered " . $cleanedInput . PHP_EOL;
}
