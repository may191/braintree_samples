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

  <script src="https://js.braintreegateway.com/v2/braintree.js"></script>

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
        <h1> Dropin UI Example</h1>
        <p>Below this is a form that we will use</p>

        <?php // we need do a server side request for the client token
        
        initBT();
        $clientToken = Braintree_ClientToken::generate();

        ?>

        <script>
          braintree.setup("<?=$clientToken; ?>", "paypal", {container: 'dropin','singleUse': true, 'amount':0.01, 'currency': 'USD'});
        </script>


        <form id="checkout" method="post" action="process/checkout.php">
          <fieldset>
            <legend>Product Option:</legend>
            <div class="form-group">
              <label for="name">Choose your Package:</label>
              <select id="product" name="price">
                <option value="5.00"> Tier One - $5.00 </option>
                <option value="10.00"> Tier Two - $10.00 </option>
                <option value="20.00"> Tier Three - $20.00 </option>
              </select>
            </div>

          </fieldset>
          <div class="col-md-8">
          <fieldset>
            <legend>Your Information:</legend>
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
              <label for="email">Email address:</label>
              <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
              <label for="mobile">Mobile Number:</label>
              <input type="tel" class="form-control" id="mobile" name="mobile">
            </div>
          </fieldset>
          </div>
          <div class="col-md-4">
          <fieldset>
            <legend>Payment Options:</legend>
            <!-- This is where the credit card details will go. -->
            <div id="dropin"></div>
            <!-- End Where Dropin UI Credit card details will go. -->
          </fieldset>
          </div>
          <div style="clear:both">
          <hr/>
          <button type="submit" class="btn btn-lg btn-success">Pay For Product!</button>
          </div>
        </form>

      </div>

    </div>

    <script src="https://js.braintreegateway.com/v1/braintree-data.js"></script>
    <script>
              BraintreeData.setup("<?=$btMerchantId; ?>", 'checkout', BraintreeData.environments.sandbox);
    </script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

  </body>
</html>