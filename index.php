<?php
	require('header.inc.php');
	require('slider.inc.php');
	require('categories.inc.php');
	
	
	$tab_query="select * from categories where status=1 order by id asc";
	$tab_result = mysqli_query($conn, $tab_query);
	$tab_menu = '';
	$tab_content = '';
	$i = 0;
	while($row = mysqli_fetch_array($tab_result)){
		
		if($i == 0){
			$tab_menu.= '<li class="active"><a href="#'.$row['id'].'" data-toggle="tab">'.$row['categories'].'</a></li>';
			$tab_content.= '<div id="'.$row['id'].'" class="tab-pane fade active in">';
		}else{
			$tab_menu.= '<li><a href="#'.$row['id'].'" data-toggle="tab">'.$row['categories'].'</a></li>';
			$tab_content.= '<div id="'.$row['id'].'" class="tab-pane fade">';
		}
		$product_query="select * from product where categories_id='".$row['id']."' and status=1 order by id desc limit 4";
		$product_result=mysqli_query($conn,$product_query);
		while($sub_row=mysqli_fetch_assoc($product_result)){
			$tab_content.= '
			<div class="col-sm-3">
				<div class="product-image-wrapper">
					<div class="single-products">
						<div class="productinfo text-center">
							<a href="product_details.php?type=detail&id='.$sub_row['id'].'">
							<img src="'.$sub_row["image"].'" height="200px" alt="PRODUCT_IMG" />
							<h2>'.$sub_row["price"].'</h2>
							<p>'.$sub_row["name"].'</p>
							</a> 
						</div>
					</div>
				</div>
			</div>';
		}
		$tab_content.='<div style="clear:both"></div></div>';
		$i++;
	}
	
	
	//wishlist code 
	if(isset($_GET['type']) && $_GET['type']!=''){
		$type=get_value($conn,$_GET['type']);
		if($type=='wishlist'){
			if(isset($_GET['user_id']) && $_GET['user_id']!=''){
				$user_id=get_value($conn,$_GET['user_id']);
				$check_result=mysqli_query($conn,"select * from users where id='$user_id'");
				if(mysqli_num_rows($check_result)>0){
					if(isset($_GET['product_id']) && $_GET['product_id']!=''){
						$product_id=get_value($conn,$_GET['product_id']);
						$check_result=mysqli_query($conn,"select * from product where id='$product_id'");
						if(mysqli_num_rows($check_result)>0){
							$added_on=date('Y-m-d h:i:s');
							$wishlist_check_result=mysqli_query($conn,"select * from wishlist where product_id='$product_id' and user_id='$user_id'");
							if(mysqli_num_rows($wishlist_check_result)>0){
								?>
									<script>
										window.location.href='index.php';
									</script>
								<?php
								die();
							}else{
								$wishlist_sql="insert into wishlist (user_id,product_id,added_on)
											values('$user_id','$product_id','$added_on')";
								mysqli_query($conn,$wishlist_sql);
								?>
									<script>
										window.location.href='index.php';
									</script>
								<?php
								die();
							}
						}else{
							?>
								<script>
									window.location.href='index.php';
								</script>
							<?php
							die();
						}
					}
				}else{
					?>
						<script>
							window.location.href='index.php';
						</script>
					<?php
					die();
				}
			}
		}else{
			?>
				<script>
					window.location.href='index.php';
				</script>
			<?php
			die();
		}
	}
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
											<h2 style="font-size:15px;">MRP <?php echo $value['mrp']?></h2>
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
									<?php
										if(isset($_SESSION['USER_ID']) && $_SESSION['USER_ID']!=''){
											
									?>
										<li><a href="index.php?type=wishlist&user_id=<?php echo $_SESSION['USER_ID']?>&product_id=<?php echo $value['id']?>">
										<i class="fa fa-plus-square"></i>Add to wishlist</a></li>
									<?php
										}else{
									?>
											<li><a href="login.php">
										<i class="fa fa-plus-square"></i>Add to wishlist</a></li>
									<?php
										}
									?>
										
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
					
					<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<?php echo $tab_menu?>
							</ul>
						</div>
						<div class="tab-content">
							<?php echo $tab_content?>
						</div>
					</div><!--/category-tab-->
					
					
					
					
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						<?php 
						$recommended_query="select product.*,categories.* from product, 
									categories where product.best_seller=1 and categories.status=1 and 
									product.status=1";
						$recommended_result=mysqli_query($conn,$recommended_query);
						if(mysqli_num_rows($recommended_result)>0){
						?>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								
								<?php 
									$recommended_count=0;
									while($recommended_row=mysqli_fetch_assoc($recommended_result)){
									
									$pro_image = $recommended_row['image'];
									
									$recommended_count = $recommended_count + 1;
									if($recommended_count == 1){
										echo "<div class='item active'>";
									}else{
										echo "<div class='item'>";
									} 
									
									$product=get_product($conn,1,3,'','desc');
									foreach($product as $value){	
								?>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center p-img">
													<a href="product_details.php?type=detail&id=<?php
													echo $value['id']?>">
													<img src="<?php echo $value['image']?>" width="80%" height="200px" alt="" />
													<h2><?php echo $value['price']?></h2>
													<p><?php echo $value['name']?></p>
													</a>
													<a href="javascript:void(0)" onclick="manage_cart('<?php echo $value['id']?>','add')" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
							<?php }?>
								</div>
								
								<?php
								}
								?>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					<?php
						}else{
							echo "please On best seller Option";
						}
					?>
		
				</div>
			</div>
		</div>
	</section>
	


<?php
	require('footer.inc.php');
?>