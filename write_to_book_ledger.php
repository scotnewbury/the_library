<?php
/**
 * write_to_book_ledger.php
 * Writes to the book.csv file the ISBN and current timestamp
 */
function writeToBookLedger($bookInfo) {
  echo "Here I am!!!" . PHP_EOL;
  $currentTimestamp = date('Y-m-d H:i:s', time());
  $handle = fopen("books.csv", "a");
  if ($handle === false) {
    die("Error: Unable to open the Book Ledger for writing.");
  }
  // fputcsv($handle, [$isbn, $currentTimestamp]);
  
  $rowData = array_values($bookInfo);
  $rowData[] = $currentTimestamp;
  fputcsv($handle, $rowData);
  echo "Writing to the ledger" . PHP_EOL;
  fclose($handle);
}
