<?php
	require('header.inc.php');
	$total_price=0;
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
	
	//delete code
	if(isset($_POST)){
		if(isset($_POST['order_id']) && isset($_POST['product_id'])
				&& $_POST['order_id']!='' && $_POST['product_id']!=''){
			
			$order_id=get_value($conn,$_POST['order_id']);
			$product_id=get_value($conn,$_POST['product_id']);
			$check_result=mysqli_query($conn,"select * from orders_detail where order_id='$order_id' and product_id='$product_id'");
			if(mysqli_num_rows($check_result)>0){
				mysqli_query($conn,"delete from orders_detail where order_id='$order_id' and product_id='$product_id'");
				
			}else{
				?>
				<script>
					window.location.href='my_order.php';
				</script>
				<?php
			}
		}
	
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
							<td class="image">Product</td>
							<td class="description">Date</td>
							<td class="price">Address</td>
							<td class="price">Payment type</td>
							<td class="price">Qty</td>
							<td class="price">Order Status</td>
							<td class="price">Total Price</td>
							<td class="price">Cancel</td>
							<td></td>
						</tr>
					</thead>
					<tbody id='tbody'>
						<?php
							$orders_sql="select * from orders where user_id='$user_id'";
							$orders_result=mysqli_query($conn,$orders_sql);
							while($row=mysqli_fetch_assoc($orders_result)){
								$date=$row['added_on'];
								$address=$row['first_address'];
								$pay_type=$row['payment_type'];
								$order_status_id=$row['order_status'];
								$order_id=$row['id'];
								$order_sql="select * from orders_detail where order_id='$order_id'";
								$order_result=mysqli_query($conn,$order_sql);
								while($order_row=mysqli_fetch_assoc($order_result)){
									$product_id=$order_row['product_id'];
									$qty=$order_row['qty'];
									$total_price=$total_price+$order_row['qty']*$order_row['price'];
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
											<img src="<?php echo $image?>" width="100px" alt="">
											</a></br>
											<div style="margin-left:5px; margin-top:10px; font-size:20px;">
												<?php echo strtoupper($pname)?>
												<span style="color:#fe980f; font-size:15px">RS[<?php echo $price?>]</span>
											</div>
							
										</td>
										
										<td class="cart_description">
											<h4><a href="product_details.php?type=detail&id=<?php
																echo $id?>"><div style="font-size:15px;"><?php echo $date?></div></a></h4>
										</td>
										<td class="cart_price">
											<p><?php echo $address?></p>
										</td>
										
										<td class="cart_price">
											<p><?php echo $pay_type?></p>
										</td>
										
										<td class="cart_price">
											<p><?php echo $qty?></p>
										</td>
										
										<td class="cart_price">
											<p style="color:#00adff;">
											<?php
												switch($order_status_id){
													case 1:
														echo 'PENDING';
														break;
														
													case 2:
														echo 'PROCESSING';
														break;
														
													case 3:
														echo 'SHIPPED';
														break;
														
													case 4:
														echo 'CANCELED';
														break;
														
													case 5:
														echo 'COMPLETE';
														break;
												}
											?>
											
											<td class="cart_price">
												<p><?php echo $qty*$price?></p>
											</td>
											
											<td class="cart_price">
												<?php if($order_status_id!=3 && $order_status_id!=5){?>
												<a href="javascript:void(0)" onclick="order_delete(<?php echo $order_id?>,<?php echo $id?>)" class="btn btn-danger">Cancel </button>
												<?php }else{
													echo "NO";
												}?>
											</td>
											
											</p>
										</td>
									</tr>
									<?php
									}
								
								}
								
							}
							
						?>
						<tr>
							<td colspan="5"></td>
							<td class="product-name" style="color:#fe980f;"><b>TOTAL PRICE WITH<span style="color:black"> GST<sapn> </b></td>
							<td class="product-name" style="color:#fe980f;"><?php echo $total_price?></td>
						</tr>
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