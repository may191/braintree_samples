<?php

include("../config.php");
initBT();

?>

<h1>Form Dump Below of all data received: </h1>

<pre>
<?php print_r($_POST); ?>
</pre>


<h2> Sending off the transaction to Braintree for processing </h2>

<pre>
<? 

$name_parts = explode(" ", $_POST['name']);

$result = Braintree_Transaction::sale(array(
  'amount' => $_POST['price'], //price from the product value
  'paymentMethodNonce' => $_POST['payment_method_nonce'], //nonce was sent by paypal
  'options' => array(
    'submitForSettlement' => True // have to do this otherwise it is just an auth
  ),
  'customer' => array(  //can optionally provide some customer details.
    'firstName' => $name_parts[0],
    'lastName' => $name_parts[1],
    'phone' => $_POST['mobile'],
    'email' => $_POST['email']
  ),
  "deviceData" => $_POST["device_data"]  //device data comes in from the front end.
));

print_r($result);

?>
</pre>