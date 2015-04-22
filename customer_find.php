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

          <h1> Customer Find</h1>
          <p>Below is a form that you can enter a customer id to look up vaulted details.</p>
          <p>&nbsp;</p>

          <?php
        if(isset($_GET['customer_id'])){ //looks like somone submited the form

          //Initialze BT SDK
          initBT();

          try{ //SDK throughs exception if not found so we have

            $customer = Braintree_Customer::find($_GET['customer_id']);

            echo "<h3>Looking up customer id: ".$_GET['customer_id']." on Braintree</h3>";
            echo '<p><a id="customer-toggle" href="#full-customer">View Full Results</a>:</p><pre style="display:none;font-size:8px;" id="full-customer">';
            print_r($customer);
            echo "</pre>";

          //Add a form here to let people add a Card for this customer.
          $clientToken = Braintree_ClientToken::generate(); //need this only cause we are adding option
          ?>

          <div class="col-md-6">
            <form id="checkout" method="post" action="process/customer_addPaymentMethod.php">
              <input type="hidden" name="customer_id" value="<?=$_GET['customer_id']; ?>" />

              <fieldset>
                <legend>Add Payment Method for <?=$customer->firstName; ?> :</legend>
                <!-- This is where the credit card details will go. -->
                <div id="dropin"></div>
                <!-- End Where Dropin UI Credit card details will go. -->
              </fieldset>

              <hr/>
              <button type="submit" class="btn btn-lg btn-success">Save Card to Custmer!</button>

            </form>
                      <script>
          braintree.setup("<?=$clientToken; ?>", "dropin", {container: 'dropin' });
          </script>
          </div>
          <div class="col-md-6">
            <fieldset>
              <?php
              //We need to make an array with all the payment methods;
              $all_payment_methods = array();
              
              foreach ($customer->creditCards as $key => $card) {
                $all_payment_methods[$card->token] = '<img src="'.$card->imageUrl.'" /> Ending In: '.$card->last4;
                if($card->default){
                  $all_payment_methods[$card->token] .= " <b>(Default)</b>";
                }
              }
              foreach ($customer->paypalAccounts as $account) {
                $all_payment_methods[$account->token] = '<img src="https://assets.braintreegateway.com/payment_method_logo/paypal.png?environment=sandbox" /> '.$account->email;
                if($account->default){
                  $all_payment_methods[$account->token] .= " <b>(Default)</b>";
                }
              }

              ?>


              <legend>Existing Payment Methods for <?=$customer->firstName; ?> :</legend>
              <p>Found (<?=count($all_payment_methods); ?>) Payment Methods: </p>
              <pre><?print_r($all_payment_methods); ?> </pre>
            </fieldset>
          </div>
          <div style="clear:both"></div>

        <?php //Going to let users create a new transaction based on 
        if(!empty($all_payment_methods)){ 
          ?>



          <div class="col-md-6" style="margin-top:100px;">
            <form id="transaction" method="post" action="process/transaction_newFromVault.php">
              <fieldset>


                <legend>New Transaction for <?=$customer->firstName; ?> :</legend>
                <div class="form-group">
                  <label for="source">Stored Funding Source:</label>
                  <select id="source" name="funding_source">
                    <?php
                    foreach ($all_payment_methods as $key => $value) {
                      echo '<option value="'.$key.'">'.strip_tags($value).'</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="type">Transaction Type:</label>
                  <select id="type" name="type">
                    <option value="auth">Authorize Only</option>
                    <option value="sale">Sale</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="amount">Transaction Amount:</label>
                  <input type="text" class="form-control" id="amount" name="amount"/>
                </div>
                <input type="hidden" name="customer_id" value="<?=$_GET['customer_id']; ?>" />

              </fieldset>

              <button type="submit" class="btn btn-lg btn-success">Charge!</button>

            </form>
          </div>

          <div class="col-md-6" style="margin-top:100px;">
            <form id="subscription" method="post" action="process/subscriptions.php">
              <fieldset>


                <legend>Subscriptions for <?=$customer->firstName; ?> :</legend>
                <div class="form-group">
                  <label for="ssource">Stored Funding Source:</label>
                  <select id="ssource" name="funding_source">
                    <?php
                    foreach ($all_payment_methods as $key => $value) {
                      echo '<option value="'.$key.'">'.strip_tags($value).'</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="stype">Action:</label>
                  <select id="stype" name="type">
                    <option value="create">Create</option>
                    <option value="cancel">Cancel</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="sid">Subscription Id:</label>
                  <input type="text" class="form-control" id="sid" name="subscription_id" value="super-plan"/>
                </div>
                <input type="hidden" name="customer_id" value="<?=$_GET['customer_id']; ?>" />

              </fieldset>

              <button type="submit" class="btn btn-lg btn-success">Do Work!</button>

            </form>
          </div>


          <div class="col-md-6" style="margin-top:100px;">
            <fieldset>
              <?php
              //We need to make an array with all the payment methods;
              $transactions = Braintree_Transaction::search(array(
                Braintree_TransactionSearch::customerId()->is($_GET['customer_id']),
                ));
                ?>
                <legend>Past Transactions for <?=$customer->firstName; ?> :</legend>
                <?php foreach ($transactions as $transaction) { ?>
                <div style="border:1px solid #999;padding:4px;">
                  <p><?=$transaction->type.' | <a target="blank" href="process/transaction_get.php?id='.$transaction->id.'">'.$transaction->id.'</a> | $'.$transaction->amount.' ('.$transaction->status.')'; ?></p>
                  <p>
                    <? 
                  if($transaction->type != "credit"){//refunds cant be updates
                    if( $transaction->status == "authorized"){ ?>
                    <a href="process/transaction_update.php?action=void&transactionId=<?=$transaction->id; ?>" class="btn btn-sm btn-warning">Void</a>
                    <a href="process/transaction_update.php?action=capture&transactionId=<?=$transaction->id; ?>" class="btn btn-sm btn-info">Capture</a>
                    <? } else if ($transaction->status == "submitted_for_settlement"){ ?>
                    <a href="process/transaction_update.php?action=void&transactionId=<?=$transaction->id; ?>" class="btn btn-sm btn-warning">Void</a>
                    <? } else if ( $transaction->status == "settled" || $transaction->status == "settling"  ){ ?>
                    <? if(empty($transaction->refundIds)){  ?>
                    <a href="process/transaction_update.php?action=refund&transactionId=<?=$transaction->id; ?>" class="btn btn-sm btn-danger">Refund</a>
                    <? }else{ ?>
                    <pre>Transaction was Refunded: <?php var_dump($transaction->refundIds); ?></pre>
                    <? } ?>
                    <? } } ?>
                  </p>
                </div>
                <? } ?>
              </fieldset>

            </div>

            <div style="clear:both"></div>



              <?php
        } //end if they have stored cards
        ?>
        <?

      }catch(Exception $e){

        echo '<h3 style="color:red">Sorry id: '.$_GET['customer_id']." is not in Braintree</h3>";
        echo '<p>Caught exception: '.$e->getMessage()."</p>";

      }

        }else{ //show the find form.
          ?>

          <div class="col-md-8">
            <form id="customer" method="get" action="customer_find.php">


              <fieldset>
                <legend>Lookup a Customer in Vault:</legend>
                <div class="form-group">
                  <label for="name">Braintree Customer ID:</label>
                  <input type="text" class="form-control" id="customer_id" name="customer_id"/>
                </div>
              </fieldset>

              <hr/>
              <button type="submit" class="btn btn-lg btn-success">Look up Customer Id on Braintree!</button>
            </form>
          </div>
      <? } //end if not get ?>


    </div>

    <script src="https://js.braintreegateway.com/v1/braintree-data.js"></script>
    <script>
    BraintreeData.setup("<?=$btMerchantId; ?>", 'transaction', BraintreeData.environments.sandbox);
    </script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <script type="text/JavaScript">
    $( document ).ready(function() {
        $('#customer-toggle').click(function(){
          $('#full-customer').slideToggle();
        });
    });
    </script>

  </body>
  </html>