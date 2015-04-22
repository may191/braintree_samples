<?php

include("../config.php");
initBT();

?>

<h1>Form Dump Below of all data received: </h1>

<pre>
<?php print_r($_POST); ?>
</pre>


<h2> Sending off the customer data to braintree for vaulting: </h2>

<pre>
<? 

$name_parts = explode(" ", $_POST['name']);

$customer_bt_data = array();

$customer_bt_data['firstName'] = $name_parts[0];
if(isset($name_parts[1])){
  $to_bt_data['lastName'] = $name_parts[1];
}
$customer_bt_data['email'] = $_POST['email'];
$customer_bt_data['phone'] = $_POST['mobile'];



$customerResult = Braintree_Customer::create($customer_bt_data);

print_r($customerResult);


if($customerResult->success){ //looks like that created succesfully.

  //we now need to add the address to the customerId returned by braintree.
  $BT_customerId = $customerResult->customer->id;

  $addressResult = Braintree_Address::create(array(
    'customerId'        => $BT_customerId,
    'firstName'         => $customer_bt_data['firstName'],
    'lastName'          => $to_bt_data['lastName'],
    'streetAddress'     => $_POST['street'],
    'locality'          => $_POST['city'],
    'region'            => $_POST['state'],
    'postalCode'        => $_POST['postal'],
    'countryCodeAlpha2' => $_POST['country']
  ));

  print_r($addressResult);

}


?>
</pre>