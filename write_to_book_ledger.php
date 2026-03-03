<?php
/**
 * write_to_book_ledger.php
 * Writes to the book.csv file the ISBN and current timestamp
 */
function writeToBookLedger($bookInfo) {
  $currentTimestamp = date('Y-m-d H:i:s', time());
  $handle = fopen("books.csv", "a");
  if ($handle === false) {
    die("Error: Unable to open the Book Ledger for writing.");
  }
  
  // Pull just the array values out
  $rowData = array_values($bookInfo);
  // Add the current timestamp to the end of the row
  $rowData[] = $currentTimestamp;
  // Write the row
  fputcsv($handle, $rowData);
  fclose($handle);
}
