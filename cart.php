<?php

session_start();
$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
	foreach($_SESSION["shopping_cart"] as $key => $value) {
		if($_POST["code"] == $key){
		unset($_SESSION["shopping_cart"][$key]);
		$status = "<div class='success'>
		Product is removed from your cart!</div>";
		} //removes product form cart
		if(empty($_SESSION["shopping_cart"]))
		unset($_SESSION["shopping_cart"]);
			}		
		}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['code'] === $_POST["code"]){
        $value['quantity'] = $_POST["quantity"];
        break; // Stop the loop after we've found the product
    }
}
  	
}
?>
<html>
<head>
<title>Cart</title>
<link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
    
  
	.success {
    background-color: #ddffdd;
    border-left: 6px solid #4CAF50;
    margin-bottom: 15px;
    padding: 12px;
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

    </style>

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


<div class="container">

<h2> Shopping Cart</h2>   



<div class=" cart">
<?php
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
?>
    
<table class="table table-hover table-condensed">
<thead>
	<tr>
		<th style="width:20%">Product</th>
		<th style="width:20%">Product Name</th>
		<th style="width:20%">Price</th>
		<th style="width:10%">Quantity</th>
		<th style="width:20%">Subtotal</th>
		
	</tr>
</thead>
<tbody>
	
<?php		
foreach ($_SESSION["shopping_cart"] as $product){
?>
<tr>
<td><img src='<?php echo $product["image"]; ?>' width="50" height="40" /></td>
<td><?php echo $product["name"]; ?><br />
<form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="remove" />
<button type='submit' class='btn btn-danger'><i class="fa fa-trash-o"></i> &nbsp; Remove Item</button>

</form>
</td>
<td>
<form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="change" />
<select name='quantity' class='quantity' onchange="this.form.submit()">
<option <?php if($product["quantity"]==1) echo "selected";?> value="1">1</option>
<option <?php if($product["quantity"]==2) echo "selected";?> value="2">2</option>
<option <?php if($product["quantity"]==3) echo "selected";?> value="3">3</option>
<option <?php if($product["quantity"]==4) echo "selected";?> value="4">4</option>
<option <?php if($product["quantity"]==5) echo "selected";?> value="5">5</option>
<option <?php if($product["quantity"]==6) echo "selected";?> value="6">6</option>
<option <?php if($product["quantity"]==7) echo "selected";?> value="7">7</option>
<option <?php if($product["quantity"]==8) echo "selected";?> value="8">8</option>
<option <?php if($product["quantity"]==9) echo "selected";?> value="9">9</option>
</select>
</form>
</td>
<td><?php echo "$".$product["price"]; ?></td>
<td><?php echo "$".$product["price"]*$product["quantity"]; ?></td>
</tr>
<?php
$total_price += ($product["price"]*$product["quantity"]);
}
?>

</tbody>
<tfoot>
	<tr>
			
			<td colspan="5" style="text-align:right"><strong>TOTAL: <?php echo "$".$total_price; ?></strong></td>
			
		</tr>
</tfoot>
</table>		
  <?php
  if ($cart_count <= 0){
	echo "<h3>Your cart is empty!</h3>";
  }
}else{
	echo "<h3>Your cart is empty!</h3>";
	}
?>
</div>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; 

?>
</div>


<br /><br />
<button type='index' class="btn btn-primary" onClick="location.href='product.php'">Continue Shopping</button>
<button type='Checkout' onclick="location.href='checkout.php'" id="checkout" class="btn btn-success" >Checkout</button>
</div>

</body>
</html>