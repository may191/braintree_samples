<?php

include("../config.php");
initBT();

?>

<h1>Form Dump Below of all data received: </h1>

<pre>
<?php print_r($_POST); ?>
</pre>



<h2> Sending vaulted card to braintreee make a new transaction </h2>

<pre>
<? 

$bt_transaction = array(
  'amount' => $_POST['amount'],
  'paymentMethodToken' => $_POST['funding_source'],
  'deviceData' => $_POST['device_data'],
  'customFields' => array(
    'shoe_size' => "9",
    'gender' => "male"
  )
);

if($_POST['type'] == 'sale'){ //if this was a sale 
  $bt_transaction['options'] = array('submitForSettlement' => True);
}

$result = Braintree_Transaction::sale($bt_transaction);

print_r($result);

?>
</pre>