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
        <h1> Customer Create</h1>
        <p>Below is a form that we will use to create a customer.</p>
        <p>&nbsp;</p>



        <form id="checkout" method="post" action="process/customer_new.php">

          </fieldset>
          <div class="col-md-8">
          <fieldset>
            <legend>1) Your Information:</legend>
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
          
          
          <div class="col-md-8">
          <fieldset>
            <legend>2) Shipping Information:</legend>
            <div class="form-group">
              <label for="street">Street:</label>
              <input type="text" class="form-control" id="street" name="street">
            </div>
            <div class="form-group">
              <label for="city">City:</label>
              <input type="text" class="form-control" id="city" name="city">
            </div>
            <div class="form-group">
              <label for="state">State/Province:</label>
              <input type="text" class="form-control" id="state" name="state">
            </div>
            <div class="form-group">
              <label for="postal">Zip/Postal:</label>
              <input type="text" class="form-control" id="postal" name="postal">
            </div>
            <div class="form-group">
              <label for="country">Country:</label>
              <input type="text" class="form-control" id="country" name="country">
            </div>
          </fieldset>
          </div>
          <div style="clear:both"></div>
          
          <hr/>
          <button type="submit" class="btn btn-lg btn-success">Save My Info in Braintree!</button>
          </div>
        </form>

      </div>

    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

  </body>
</html>