<?php 
		
		
        if(!empty($_REQUEST['firstname'])){
            $firstname = $_REQUEST['firstname'];
        }
    else
    {
        $firstname = NULL;
        echo '<p class ="error"> Please enter your first name</p>';
    }
    
     if(!empty($_REQUEST['lastname'])){
            $lastname = $_REQUEST['lastname'];
        }
    else
    {
        $lastname = NULL;
        echo '<p class ="error"> Please enter your last name</p>';
    }
    
     
    
    if(isset($_REQUEST['payment']))
    {
        $payment = $_REQUEST['payment'];
        
        if ($payment == 'debit')
    {
        $message = '<p><strong> Debit</strong></p>';
    } elseif($payment == 'credit')
        {
        $message = '<p><strong> Credit</strong></p>';
    }
    else{
        $payment = NULL;
        echo '<p class = "error">Please Select debit or credit</p>';
    }
    }else 
    {
        $payment = null;
        echo '<p class = "error">Please select payment method</p>';
    }
    
    
    
    if($firstname && $lastname && $payment)
    {
        $servername = "localhost";
$username = "root";
$password = "";
$dbname = "clothstore";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO user (firstname, lastname, payment)
VALUES ('".$_POST["firstname"]."','".$_POST["lastname"]."','".$_POST["payment"]."')";

        //shows alert msg if submits successfully, and redirects to inventory automatically after 3 seconds
if ($conn->query($sql) === TRUE) {
echo "<script type= 'text/javascript'>alert('Thank you for shopping with us...');</script>
";
    echo "<meta http-equiv = 'refresh' content = '3; url =index.php' />";
} else {
echo "<script type= 'text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error."');</script>";
}

$conn->close();
		
		
		
    }else {
		
        echo '<p class = "error"> <strong>Please enter your details.</strong></p>';
    }
    
    

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Simple HTML Form</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
  
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    
  
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }

	.navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    .form{
        padding: 50px;
        max-width: 50%;
        margin: auto;
    }

  </style>  
    <style type="text/css">
        label {
            font-weight: bold;
            color: #300ACC;
        }
        * { box-sizing: border-box; }

body {
  font-family: sans-serif;
}

/* ---- button ---- */

.button {
  display: inline-block;
  padding: 0.5em 1.0em;
  margin-bottom: 10px;
  background: #EEE;
  border: none;
  border-radius: 7px;
  background-image: linear-gradient( to bottom, hsla(0, 0%, 0%, 0), hsla(0, 0%, 0%, 0.2) );
  color: #222;
  font-family: sans-serif;
  font-size: 16px;
  cursor: pointer;
}

.button:hover {
  background-color: #8CF;
  color: #222;
}

.button:active,
.button.is-checked {
  background-color: #28F;
}

.button.is-checked {
  color: white;
}

.button:active {
  box-shadow: inset 0 1px 10px hsla(0, 0%, 0%, 0.8);
}

/* ---- button-group ---- */

.button-group:after {
  content: '';
  display: block;
  clear: both;
}

.button-group .button {
  float: left;
  border-radius: 0;
  margin-left: 0;
  margin-right: 1px;
}

.button-group .button:first-child { border-radius: 0.5em 0 0 0.5em; }
.button-group .button:last-child { border-radius: 0 0.5em 0.5em 0; }

/* ---- grid ---- */

.grid {
  border: 1px solid #333;
  max-width: 720px;
}

/* clear fix */
.grid:after {
  content: '';
  display: block;
  clear: both;
}

/* ---- .element-item ---- */

.item {
  float: left;
  width: 100px;
  height: 100px;
  margin: 5px;
  padding: 10px;
  background: #888;
}

.item .number {
  font-size: 50px;
  text-align: center;
  margin: 0;
}

.item[data-color="red"] { background: red; }
.item[data-color="blue"] { background: blue; }
.item[data-color="yellow"] { background: yellow; }
    </style>
<script>

// init Isotope
var $grid = $('.grid').isotope({
  itemSelector: '.item',
  layoutMode: 'fitRows',
  getSortData: {
    color: '[data-color]',
    number: '.number parseInt'
  },
  // sort by color then number
  sortBy: [ 'color', 'number' ]
});

// bind sort button click
$('.sort-by-button-group').on( 'click', 'button', function() {
  var sortValue = $(this).attr('data-sort-value');
  // make an array of values
  sortValue = sortValue.split(',');
  $grid.isotope({ sortBy: sortValue });
});

// change is-checked class on buttons
$('.button-group').each( function( i, buttonGroup ) {
  var $buttonGroup = $( buttonGroup );
  $buttonGroup.on( 'click', 'button', function() {
    $buttonGroup.find('.is-checked').removeClass('is-checked');
    $( this ).addClass('is-checked');
  });
});

</script>
</head>

<body>

<?php
if (!empty($_SESSION['shopping_cart'])) {
    $cart_count = count(array_keys($_SESSION['shopping_cart']));
}
else{
  $cart_count=null;
}
?>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php">Clothing Store</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="product.php">Products</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
   
        <li><a href="cart.php">cart<span class="glyphicon glyphicon-shopping-cart"></span><?php echo $cart_count; ?></span></a></li>
      </ul>
    </div>
  </div>
</nav>
<h2 class="text-center">Checkout</h2>
<form  method="post" class="form">
  <div class="form-group row">
    <label for="inputfirstname" class="col-sm-2 col-form-label">First Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="firstname"  placeholder="Enter First Name">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputlastname" class="col-sm-2 col-form-label">Last Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control"  name="lastname" id="inputlastname" placeholder="Enter Last Name">
    </div>
  </div>
  <fieldset class="form-group">
    <div class="row">
      <label class="col-form-label col-sm-2 pt-0">Payment Type</label>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="payment" value="debit" >
          <label class="form-check-label" for="gridRadios1">
           Debit
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio"  name="payment" value="credit" >
          <label class="form-check-label" for="gridRadios2">
            Credit
          </label>
        </div>
      </div>
    </div>
  </fieldset>
 
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" name="submit" class="btn btn-primary">Pay Now</button> <a href="index.php" type="submit" class="btn btn-success">Continue Shopping</a>
    </div>
  </div>

</div>
</body>
</html>
