<?php
/**
 * write_to_book_ledger.php
 * Writes to the book.csv file the ISBN and current timestamp
 */
function writeToBookLedger($bookInfo) {
  $currentTimestamp = date('Y-m-d H:i:s', time());
  // Create an absoloute path for the ledger
  $ledgerPath = __DIR__ . '/../data/books.csv';
  // Create the directory if it isn't there
  if (!is_dir(__DIR__ . '/../data')) {
    mkdir(__DIR__ . '/../data/', 0755, true);
  }
  $handle = fopen("$ledgerPath", "a");
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
