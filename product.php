<?php
	require('header.inc.php');
	
	if(isset($_GET['type']) && $_GET['type']!=''){
		$get_it=get_value($conn,$_GET['type']);
		if($get_it=='categories'){
			if(isset($_GET['id']) && $_GET['id']!=''){
				$id=get_value($conn,$_GET['id']);
				$check_sql="select * from categories where id='$id'";
				$check_result=mysqli_query($conn,$check_sql);
				if(mysqli_num_rows($check_result)>0){
					$cat_product=get_product($conn,'','','','',$id);
				}else{
					?>
						<script>
							window.location.href="index.php";
						</script>
					<?php
					die();
				}
			}
		}else{
			?>
				<script>
					window.location.href="index.php";
				</script>
			<?php
			die();
		}
	}
	require('categories.inc.php');
	
	if(isset($cat_product) && $cat_product!=''){
	?>
		<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						<?php
							$count=0;
							foreach($cat_product as $value){	
							$count++;
						?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="<?php echo $value['image']?>" height='250px' alt="" />
											<h2><?php echo $value['price']?></h2>
											<p><?php echo $value['name']?></p>
											<a href="javascript:void(0)" onclick="manage_cart('<?php echo $value['id']?>','add')" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										
										<div class="product-overlay">
											<div class="overlay-content">
												<h2><?php echo $value['price']?></h2>
												<p><?php echo $value['name']?></p>
												<a href="javascript:void(0)"  onclick="manage_cart('<?php echo $value['id']?>','add')" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div>
										
								</div>
								
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="index.php?type=wishlist&user_id=<?php echo $_SESSION['USER_ID']?>&product_id=<?php echo $value['id']?>"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="product_details.php?type=detail&id=<?php
													echo $value['id']?>"><i class="fa fa-plus-square"></i>Product Details</a></li>
									</ul>
								</div>
							</div>
						</div>
						<?php
						}
						?>
						
					</div><!--features_items-->
					<ul class="pagination">
						<?php
							if($count>6){
								echo '<li><a href="">Next</a></li>';
							}
						?>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<?php
	}else{
?>
	<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						<?php
							$products=get_product($conn,'',6);
							foreach($products as $value){	
						?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="<?php echo $value['image']?>" height='250px' alt="" />
											<h2><?php echo $value['price']?></h2>
											<p><?php echo $value['name']?></p>
											<a href="javascript:void(0)" onclick="manage_cart('<?php echo $value['id']?>','add')" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										
										<div class="product-overlay">
											<div class="overlay-content">
												<h2><?php echo $value['price']?></h2>
												<p><?php echo $value['name']?></p>
												<a href="javascript:void(0)"  onclick="manage_cart('<?php echo $value['id']?>','add')" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div>
										
								</div>
								
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="product_details.php?type=detail&id=<?php
													echo $value['id']?>"><i class="fa fa-plus-square"></i>Product Details</a></li>
									</ul>
								</div>
							</div>
						</div>
						<?php
						}
						?>
						
					</div><!--features_items-->
					<ul class="pagination">
							<li class="active"><a href="">1</a></li>
							<li><a href="">2</a></li>
							<li><a href="">3</a></li>
							<li><a href="">&raquo;</a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>
<?php
	}
	require('footer.inc.php');
?>