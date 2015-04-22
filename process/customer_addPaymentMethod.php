<?php

include("../config.php");
initBT();

?>

<h1>Form Dump Below of all data received: </h1>

<pre>
<?php print_r($_POST); ?>
</pre>



<h2> Sending card to braintreee to save with existing customer </h2>

<pre>
<? 

$result = $result = Braintree_PaymentMethod::create(array(
    'customerId' => $_POST['customer_id'],
    'paymentMethodNonce' => $_POST['payment_method_nonce']
));

print_r($result);

?>
</pre>