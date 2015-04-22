    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Braintree</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropin UI <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="dropin.php">Basic Dropin</a></li>
                <li><a href="dropin-pponly.php">PayPal Only Dropin</a></li>
                <li><a href="dropin-pponly-single.php">PayPal Only Dropin - Single Use (Hermes)</a></li>
                <li><a href="dropin-pponly-pullship.php">PayPal Shortcut Flow</a></li>
                <li><a href="dropin-pponly-shipover.php">PayPal Mark Override Shipping</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Custom Fields <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="custom.php">Custom with PayPal</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Vaulting <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="customer.php">Save Customer and Address</a></li>
                <li><a href="customer_search.php">List all Customers</a></li>
                <li><a href="customer_find.php">Find a Customer</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>