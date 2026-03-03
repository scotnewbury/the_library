<?php

$isbn = "9781603020220";
$url = "http://openlibrary.org/search.json?q=". $isbn;

echo $url . PHP_EOL;

// Grab the json from the Open Library API
$jsonData = file_get_contents($url);

// // Conver the data to an associative array
$bookData = json_decode($jsonData, true);

// Check that we received book information
if ($bookData['numFound'] > 0) {
    $book = $bookData['docs'][0];
    
    // Now you can access the 'data' key which contains the title
    $title = $book['title'];
} else {
    echo "No records found for this ISBN.";
} 

echo $bookData['docs']['0']['title'] . PHP_EOL;

// https://openlibrary.org/search.json?q=9781603020220