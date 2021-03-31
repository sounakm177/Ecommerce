<?php
	require('header.inc.php');
	require('categories.inc.php');
	
	//search code 
	if(isset($_GET['str']) && $_GET['str']!=''){
		$str=get_value($conn,$_GET['str']);
		$products=get_product($conn,'','','','','',$str);
		
		if(count($products)==0){
			echo "<b>NOT FOUND SEARCH DATA!!</b>";
		}
	}else{
	?>
		<script>
			window.location.href="index.php";
		</script>
	<?php
		die();
	}
?>
	<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						<?php
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
				</div>
			</div>
		</div>
	</section>
<?php
	require('footer.inc.php');
?>