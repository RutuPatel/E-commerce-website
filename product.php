<?php

session_start();
include('db.php');
$status="";
if (isset($_POST['code']) && $_POST['code']!=""){
$code = $_POST['code'];
$result = mysqli_query($con,"SELECT * FROM `products` WHERE `code`='$code'");
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$code = $row['code'];
$price = $row['price'];
$image = $row['image'];

    //array for cart
$cartArray = array(
	$code=>array(
	'name'=>$name,
	'code'=>$code,
	'price'=>$price,
	'quantity'=>1,
	'image'=>$image)
);

    //shows msg when item is added to cart
if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartArray;
	$status = "<div class='success'>Product is added to your cart!</div>";
}else{
    
    //shows msg if item is already in cart
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($code,$array_keys)) {
		$status = "<div class='danger'>
		Product is already added to your cart!</div>";	
	} else {
	$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
	$status = "<div class='success'>Product is added to your cart!</div>";
	}

	}
}

?>
<html>
<head>
<title>Best Buy</title>

 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
	.jumbotron {
    margin-bottom: 50px;
	}
  .success {
    background-color: #ddffdd;
    border-left: 6px solid #4CAF50;
    margin-bottom: 15px;
    padding: 12px;
}

.danger {
    background-color: #ffdddd;
    border-left: 6px solid #f44336;
    margin-bottom: 15px;
    padding: 12px;
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


<div class="jumbotron">
  <div class="container text-center">
    <h1>Online Store</h1>      
    <p>Mission, Vission & Values</p>
  </div>
</div>

<div style="width:700px; margin:50 auto;">




<div class="message_box" style="margin:10px 0px;">
<p><?php echo $status; ?></p>
</div>


<?php

// <div class="col-sm-4">
// <div class="panel panel-success">
//   <div class="panel-heading">White Shorts</div>
//   <div class="panel-body"><img src="https://lp2.hm.com/hmgoepprod?set=source[/2b/a2/2ba2e08b670919c8ef3433f75331b122ff2f565f.jpg],origin[dam],category[ladies_shorts],type[LOOKBOOK],res[y],hmver[1]&call=url[file:/product/main]" class="img-responsive" style="width:100%" alt="Image"></div>
//   <div class="panel-footer">$199.23 &nbsp; &nbsp; &nbsp;<button  class="btn btn-success">Buy Now</button></div>
// </div>
// </div>
    //displays products from database
	$q = "SELECT * FROM products";
$result = mysqli_query($con,$q);
while($row = mysqli_fetch_assoc($result)){
    
 
 
    echo "<div class='col-sm-4'>";
		echo "<div class='panel panel-success'>
			  <form method='post' action=''>
        <input type='hidden' name='code' value=".$row['code']." />
        <div class='panel-heading'>".$row['name']."</div>
        <div class='panel-body'><img src=".$row['image']." class='img-responsive' style='width:100%' alt='Image'></div>
        <div class='panel-footer'>$".$row['price']." &nbsp; &nbsp; &nbsp; <button type='submit' class='buy'>Buy Now</button></div>
			  </form>
		   	  </div>";
    echo "</div>";
   
        }
mysqli_close($con);

?>

<div style="clear:both;"></div>


<br /><br />
</div>


<footer class="container-fluid text-center">
  <p>Online Store Copyright</p>  
  <form class="form-inline">Get deals:
    <input type="email" class="form-control" size="50" placeholder="Email Address">
    <button type="button" class="btn btn-danger">Sign Up</button>
  </form>
</footer>
</body>
</html>