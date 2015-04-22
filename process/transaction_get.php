<?php

include("../config.php");
initBT();

?>

<h1>Form Dump Below of all data received: </h1>

<pre>
<?php print_r($_GET); ?>
</pre>



<h2> Sending request to Braintree to get <?=$_GET['id']; ?> transaction. </h2>

<pre>
<? 



//You have an individual transaction object.
$transaction = Braintree_Transaction::find($_GET['id']);

//This Refunded Transaction does not include the original customFields.
print_r($transaction);


//This Refunded Transaction now DOES include the original customFields.
$updated_transaction = includeCustomVariablesFromRefundedTransaction($transaction);
print_r($updated_transaction);








function includeCustomVariablesFromRefundedTransaction($refundTransactionObject){

	$customVariables = array();
	$originalTransaction = Braintree_Transaction::find($refundTransactionObject->refundedTransactionId);
	
	if(empty($refundTransactionObject->customFields)){
		//The Original Transaction
		$refundTransactionObject->customFields = $originalTransaction->customFields;
	}else{
		array_merge ( $refundTransactionObject->customFields, $originalTransaction->customFields);
	}
	return $refundTransactionObject;

}


?>
</pre>