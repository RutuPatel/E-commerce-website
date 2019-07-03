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
	$status = "<div class='box'>Product is added to your cart!</div>";
}else{
    
    //shows msg if item is already in cart
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($code,$array_keys)) {
		$status = "<div class='box' style='color:red;'>
		Product is already added to your cart!</div>";	
	} else {
	$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
	$status = "<div class='box'>Product is added to your cart!</div>";
	}

	}
}

?>
<html>
<head>
<title>Best Buy</title>
<link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
    
  .carousel-inner img {
      width: 100%; /* Set width to 100% */
      margin: auto;
      min-height:200px;
  }

  /* Hide the carousel text when the screen is less than 600 pixels wide */
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
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

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="https://lp2.hm.com/hmgoepprod?set=width[1280],quality[80],options[limit]&source=url[https://www2.hm.com/content/dam/campaign-divided-s09/6079b/6079B-3x2-Stay-true-stay-you.jpg]&scale=width[global.width],height[15000],options[global.options]&sink=format[jpg],quality[global.quality]" alt="Image">
        <div class="carousel-caption">
          <h3>College Clothing</h3>
          <p>FOR ALL  TINGER</p>
        </div>      
      </div>

      <div class="item">
        <img src="https://lp2.hm.com/hmgoepprod?set=width[1280],quality[80],options[limit]&source=url[https://www2.hm.com/content/dam/campaign-kids-s09/4210d/4210D-3x2-say-it-with-sequins.jpg]&scale=width[global.width],height[15000],options[global.options]&sink=format[jpg],quality[global.quality]" alt="Image">
        <div class="carousel-caption">
          <h3>kids Shopping</h3>
          <p>Cutest Collection Ever</p>
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
  
<div class="container text-center">    
  <h3>Newest Arrivals</h3><br>
  <div class="row">
    <div class="col-sm-4">
      <img src="https://lp2.hm.com/hmgoepprod?set=source[/87/cd/87cd1dc6483e7af7bcc508dd4eefce44aaab018b.jpg],origin[dam],category[kids_boy8y_topstshirts_shortsleeves],type[LOOKBOOK],res[m],res[m],hmver[1]&call=url[file:/product/main]" class="img-responsive" style="width:100%;" alt="Image">
     
    </div>
    <div class="col-sm-4"> 
      <img src="https://lp2.hm.com/hmgoepprod?set=source[/da/9c/da9c54fc263f44abc3c6307418454c5f104f76a0.jpg],origin[dam],category[men_tshirtstanks_shortsleeve],type[LOOKBOOK],res[m],res[m],hmver[1]&call=url[file:/product/main]" class="img-responsive" style="width:100%" alt="Image">
       
    </div>
    <div class="col-sm-4"> 
      <img src="https://lp2.hm.com/hmgoepprod?set=source[/df/8d/df8dc3cb332bd0ea01351d299a92a5c612eee4d7.jpg],origin[dam],category[ladies_shorts],type[LOOKBOOK],res[m],res[m],hmver[1]&call=url[file:/product/main]" class="img-responsive" style="width:100%" alt="Image">
      
    </div>
  </div>
</div><br>


<footer class="container-fluid text-center">
  <p>Online Store Copyright</p>  
  <form class="form-inline">Get deals:
    <input type="email" class="form-control" size="50" placeholder="Email Address">
    <button type="button" class="btn btn-danger">Sign Up</button>
  </form>
</footer>

</body>
</html>