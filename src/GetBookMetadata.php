<?php

/**
 * GetBookMetadata.php
 * Used to pull the information from the Open Library API
 */

namespace Library;

class GetBookMetadata {
  public function getBookMetadata ($isbn) {
    // Create the URL for the API call
    $url = "http://openlibrary.org/search.json?q=". $isbn;

    // Grab the json from the Open Library API
    $jsonData = file_get_contents($url);

    // Did we get json data from the call?
    if ($jsonData === false || empty($jsonData)) {
      echo "Error: Could not fetch data from the API.";
      return [
        'status' => 'No Data',
      ];
    } else {
      // // Conver the data to an associative array
        $bookData = json_decode($jsonData, true);

        // Check that we received book information
        if ($bookData['numFound'] > 0) {
            $book = $bookData['docs'][0];
            
            // Now you can access the 'data' key which contains the title
            $title = $book['title'];
            return [            
              'isbn' => $isbn,
              'title' => $title,
            ];
        } else {
            echo "No records found for this ISBN.";
        } 
    }
  }
}
