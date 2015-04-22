<?php
  include("config.php");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Braintreee v.zeo Practice</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <!-- Fixed navbar -->
    <? include("common/nav.php"); ?>

    <div class="container theme-showcase" role="main" style="margin-top:90px">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1> Customer Search</h1>
        <p>Below is a list of all customers vaulted in the last 6 months.</p>
        <p>&nbsp;</p>
        <?php 

        initBT();


        $now = new Datetime();
        $past = clone $now;
        $past = $past->modify("-6 month");

        $customers = Braintree_Customer::search(array(
          Braintree_CustomerSearch::createdAt()->between($past, $now)
        ));

        //$customers = Braintree_Customer::all();
        //Doesent seem to give details

        ?>
        <ul>
        <? foreach ($customers as $customer) {
          echo '<li><a href="customer_find.php?customer_id='.$customer->id.'">'.$customer->firstName.' (Has '.count($customer->paymentMethods).' funding options) </a></li>';
        }
        ?>
        </ul>
      </div>

    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

  </body>
</html>