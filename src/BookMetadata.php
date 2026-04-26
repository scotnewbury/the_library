<?php

/**
 * GetBookMetadata.php
 * Used to pull the information from the Open Library API
 */

namespace Library;

use GuzzleHttp\Client;

class BookMetadata
{

    public $libraryClient;

    function __construct($theClient = null)
    {
        $this->libraryClient = $theClient ?? new Client();
    }

    public function getBook($isbn)
    {
        // Create the URL for the API call
        $url = "http://openlibrary.org/search.json?q=" . $isbn;

        // Grab the json from the Open Library API
        $response = $this->libraryClient->get($url);
        $jsonData = $response->getBody()->getContents();

        // Did we get json data from the call?
        if ($jsonData === false || empty($jsonData)) {
            throw new \Exception("Could not fetch data from the Open Library API.");
        } else {
            // Convertt the data to an associative array
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
                throw new \Exception("No records found for this ISBN.");
            }
        }
    }
}
