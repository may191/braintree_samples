<?php

// *********************************************** //
// **** Original Transaction Custom Variables **** //
// ************** example by: R. May ************* //
// *********************************************** //

echo "<h1>Original Transaction Custom Variables Example</h1>";
echo "<p>This example illustrates how to get customFields asociated with the original transaction.</p>";

// Import the Braintree PHP SDK thats stored locally
// You would need to update this to point to your location.
require("../braintree_php/lib/Braintree.php");


// I am going to Hardcode some sandbox credentials for this example.
// These would obviously be replaced by your own to go live.
Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('mds9wr54trt8q7qx');
Braintree_Configuration::publicKey('7rd5sp9sj93x46h4');
Braintree_Configuration::privateKey('3271d2ddffe03b45c5389d7128338022');


// I have just hardcoded an Id for an existing refunded transaction.
// You know a transaction has been refunded when if(!empty($refundTransactionObject->refundedTransactionId))
$refundedTransactionId = "72rtqt";

// Whe are going to lookup a refunded transaction with its transactionId like normal
$transaction = Braintree_Transaction::find($refundedTransactionId);

// If you were to look for the custom fields associated with the refund it will be empty.
$customFields = $transaction->customFields;

//Lets dump this out to the view so you can see its empy.
echo "<h2>Dumping the customFields array for the transaction:</h2>";
echo '<pre>';
print_r($customFields);
echo "</pre>";
echo "<p>Oh No! Nothing there. How will i figure out gender and shoe size of the refund?";


// *********************************************************************** //
// Lets try to get at the custom fields again using a handy littl function.
// *********************************************************************** //
// *  This function, if it detects the transaction is a refund,          * //
// *  will return the orginal transaction customVariables instead.       * //
// *********************************************************************** //

// Assign custom fields this time through the new function.
$customFields = getOriginalCustomVariables($transaction);

//Lets dump this out to the view so you can see its empy.
echo "<h2>Dumping the customFields array for the transaction:</h2>";
echo "<pre>";
print_r($customFields);
echo "</pre>";
echo "<p>Nice! Few.. That wasnt so bad.";




// Handy function below you can include in your project.

function getOriginalCustomVariables($refundTransactionObject)
{

	if(!empty($refundTransactionObject->refundedTransactionId))
	{ //if this is a refunded transaction we should have a refundedTransactionId set.

		// lookup the original transaction
		$originalTransaction = Braintree_Transaction::find($refundTransactionObject->refundedTransactionId);
		
		//Return the customFields from the original
		return $originalTransaction->customFields;

	}else{ // Transaction does not have associated sale transaction. So lets use this transactions instead if it is an original.

		//return the custom fields for the same transaction
		return $refundTransactionObject->customFields;

	}

}


?>