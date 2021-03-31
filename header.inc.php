<?php
	require('connection.inc.php');
	require('function.inc.php');
	$wishlist_count='';
	
	//wishlist count code
	if(isset($_SESSION['USERLOGIN']) && $_SESSION['USERLOGIN']='yes'){
		$user_id=$_SESSION['USER_ID'];
		$wishlist_result=mysqli_query($conn,"select * from wishlist where user_id='$user_id'");
		$wishlist_row=mysqli_num_rows($wishlist_result);
		if($wishlist_row>0){
			$wishlist_count=$wishlist_row;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">	
	<link href="css/custom.css" rel="stylesheet">
<style>
	
	.cart1 {
    background: #c43b68;
    border-radius: 100%;
    color: #fff;
    font-size: 9px;
    height: 17px;
    line-height: 19px;
    position: absolute;
    right: -18px;
    text-align: center;
    top: -5px;
    width: 17px;
}
</style>	
</head><!--/head-->




<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +0 00 00 0000</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> Sounak@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.php"><img src="images/home/logo.png" alt="" /></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
							
							<?php
								if(isset($_SESSION['USERLOGIN']) && $_SESSION['USERLOGIN']=='yes'){
										//echo '<li><a href="#"><i class="fa fa-user"></i> Account</a></li>';
										echo '<li><a href="wishlist.php"><i class="fa fa-star"></i> Wishlist';
											
										if($wishlist_count>0){
											echo '<span class="cart1">'.$wishlist_count.'</span></a></li>';
										}else{
											echo '</a></li>';
										}
										echo '<li><a href="checkout.php"><i class="fa fa-crosshairs"></i> Checkout</a></li>';
										echo '<li><a href="my_order.php"><i class="fa fa-crosshairs"></i> My Order</a></li>';
								}
							?>
								<li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Cart
								<!--<span class="cart1"></span></a></li> -->
								
								<?php
									if(isset($_SESSION['USERLOGIN']) && $_SESSION['USERLOGIN']=='yes'){
										echo '<li><a href="logout.php"><i class="fa fa-unlock"></i> Logout</a></li>';
									}else{
										echo '<li><a href="login.php"><i class="fa fa-lock"></i> Login</a></li>';
									}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.php">Home</a></li>
								<li><a href="product.php">Product</a></li>
								<li><a href="contact.php">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<form action="search.php" method="get">
								<input type="text" name="str" placeholder="Search"/>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	