<?php

include("../config.php");
initBT();

?>

<h1>Form Dump Below of all data received: </h1>

<pre>
<?php print_r($_GET); ?>
</pre>



<h2> Sending request to Braintree to <?=$_GET['action']; ?> transaction. </h2>

<pre>
<? 

if($_GET['action'] == 'refund'){

  $result = Braintree_Transaction::refund($_GET['transactionId']);

}else if ($_GET['action'] == 'void'){

  $result = Braintree_Transaction::void($_GET['transactionId']);

}else if ($_GET['action'] == 'capture'){

  $result = Braintree_Transaction::submitForSettlement($_GET['transactionId']);
}


print_r($result);

?>
</pre>