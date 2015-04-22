<?php

//Start a session regardless. 
session_start();

//BT Credentials from BT Dashboard - may191
// Portal At: https://sandbox.braintreegateway.com


$btMerchantId = "";
$btEnvironment = "sandbox";


function initBT($env = "sandbox")
{

	require("braintree_php/lib/Braintree.php");

	if($env == "sandbox")
	{

		//Ryan's Sandbox Merchant Account
		global $btMerchantId;

		Braintree_Configuration::environment('sandbox');
		Braintree_Configuration::merchantId($btMerchantId = '{yoursGoesHere}');
		Braintree_Configuration::publicKey('{yoursGoesHere}');
		Braintree_Configuration::privateKey('{yoursGoesHere}');


	}else{
		
		//Jimmies Live Account
		global $btMerchantId;

		Braintree_Configuration::environment('production');
		Braintree_Configuration::merchantId($btMerchantId = '{yoursGoesHere}');
		Braintree_Configuration::publicKey('{yoursGoesHere}');
		Braintree_Configuration::privateKey('{yoursGoesHere}');

	}

}


?> 