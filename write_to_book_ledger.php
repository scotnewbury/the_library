<?php
/**
 * write_to_book_ledger.php
 * Writes to the book.csv file the ISBN and current timestamp
 */
function writeToBookLedger($isbn) {
  $currentTimestamp = date('Y-m-d H:i:s', time());
  $handle = fopen("books.csv", "a");
  fputcsv($handle, [$isbn, $currentTimestamp]);
  fclose($handle);
}
