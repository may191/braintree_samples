<?php
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');
include("../config.php");
initBT();



// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('type', 'id', 'amount', 'status', 'first_name'));


$now = new Datetime();
$past = clone $now;
$past = $past->modify("-1 month");

$transactions = Braintree_Transaction::search(array(
  Braintree_TransactionSearch::createdAt()->between($past, $now)
));

foreach ($transactions as $transaction) { 

  $row = array();
  $row['type'] = $transaction->type;
  $row['id'] = $transaction->id;
  $row['amount'] = $transaction->amount;
  $row['status'] = $transaction->status;
  $row['first_name'] = $transaction->customerDetails->firstName;

  fputcsv($output, $row);
}


?>