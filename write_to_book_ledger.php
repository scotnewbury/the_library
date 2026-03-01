<?php
/**
 * write_to_book_ledger.php
 * Writes to the book.csv file the ISBN and current timestamp
 */
function writeToBookLedger($isbn) {
  $currentTimestamp = date('Y-m-d H:i:s', time());
  $handle = fopen("books.csv", "a");
  if ($handle === false) {
    die("Error: Unable to open the Book Ledger for writing.");
  }
  fputcsv($handle, [$isbn, $currentTimestamp]);
  fclose($handle);
}
