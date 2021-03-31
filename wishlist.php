<?php
	require('header.inc.php');
	if(isset($_SESSION['USERLOGIN']) && $_SESSION['USERLOGIN']=='yes'){
		$user_id=$_SESSION['USER_ID'];
	}else{
		?>
			<script>
				window.location.href="index.php";
			</script>
		<?php
		die();
	}
	
	$wishlist_sql="select * from wishlist where user_id='$user_id'";
	$wishlist_result=mysqli_query($conn,$wishlist_sql);
	
	if(mysqli_num_rows($wishlist_result)>0){
		
	}else{
		?>
			<script>
				window.location.href="index.php";
			</script>
		<?php
		die();
	}
?>


	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="index.php">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">MRP</td>
							<td class="price">Price</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php
							
							
							while($row=mysqli_fetch_assoc($wishlist_result)){
								$product_id=$row['product_id'];
								$sql="select * from product where id='$product_id'";
								$result=mysqli_query($conn,$sql);
								while($row=mysqli_fetch_assoc($result)){
									$id=$row['id'];
									$image=$row['image'];
									$pname=$row['name'];
									$price=$row['price'];
									
							?>
									<tr>
										<td class="cart_product">
										<a href="product_details.php?type=detail&id=<?php
															echo $id?>">
										<img src="<?php echo $image?>" width="150px" alt=""></a>
										</td>
										<td class="cart_description">
											<h4><a href="product_details.php?type=detail&id=<?php
																echo $id?>"><?php echo $pname?></a></h4>
										</td>
										<td class="cart_price">
											<p><?php echo $row['mrp']?></p>
										</td>
										
										<td class="cart_price">
											<p><?php echo $price?></p>
										</td>
										
										<td class="cart_delete">
											<a class="cart_quantity_delete" href="javascript:void(0)" onclick="wishlist_remove('<?php echo $id?>','<?php echo $user_id?>')"><i class="fa fa-times"></i></a>
										</td>
									</tr>
									<?php
								}
								
								
							}
							
						?>
						
						
						
						
						<?php
							
						
						?>
					</tbody>
				</table>
			
			</div>
		</div>
	</section> <!--/#cart_items-->
<?php
	require('footer.inc.php');
?>