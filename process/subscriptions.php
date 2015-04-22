<?php

include("../config.php");
initBT();

?>

<h1>Form Dump Below of all data received: </h1>

<pre>
<?php print_r($_POST); ?>
</pre>



<h2> Sending request to Braintree to <?=$_POST['type']; ?> subscription. </h2>

<pre>
<? 

if($_POST['type'] == 'create'){

  $result = Braintree_Subscription::create(array(
	  'paymentMethodToken' => $_POST['funding_source'],
	  'planId' => $_POST['subscription_id']
	));

}

print_r($result);

?>
</pre>