<?php

function getBookMetadata ($isbn) {
  // Create the URL for the API call
  $url = "http://openlibrary.org/search.json?q=". $isbn;

  // Grab the json from the Open Library API
  $jsonData = file_get_contents($url);

  // Did we get json data from the call?
  if ($jsonData === false || empty($jsonData)) {
    die("Error: Could not fetch data from the API.");
  }

  // // Conver the data to an associative array
  $bookData = json_decode($jsonData, true);

  // Check that we received book information
  if ($bookData['numFound'] > 0) {
      $book = $bookData['docs'][0];
      
      // Now you can access the 'data' key which contains the title
      $title = $book['title'];
      return [
        'title' => $title,
      ];
  } else {
      echo "No records found for this ISBN.";
  } 
}

$isbn = "9781603020220";

$bookInfo = getBookMetadata($isbn);

echo "The book title is: " . $bookInfo['title'] . PHP_EOL;