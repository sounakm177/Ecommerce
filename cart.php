<?php
	require('header.inc.php');
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
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php	
							$totalprice=0;
							if(isset($_SESSION['cart']) && $_SESSION['cart']!=''){
							foreach($_SESSION['cart'] as $key=>$value){
								$productArr=get_product($conn,'','',$key);
								$pname=$productArr[0]['name'];
								$mrp=$productArr[0]['mrp'];
								$price=$productArr[0]['price'];
								$image=$productArr[0]['image'];
								$id=$productArr[0]['id'];
								$qty=$value['qty'];
									
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
								<p><?php echo $price?></p>
							</td>
							<td class="cart_qty">
								
									<input type="number" id="<?php echo $key?>qty" value="<?php  
									if($qty<=0){
										$qty=1;
										echo $qty;
									}else{
										echo $qty;
									}
									?>"/>
									<a class="btn btn-sm btn-success" href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','update')">update</a>
								
							</td>
							<td class="cart_total">
								<p class="cart_total_price"><?php 
								
								echo $qty*$price;
								$totalprice+=$qty*$price;
								
								?></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','remove')"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						
						<?php
							}
						}
						?>
					</tbody>
				</table>
			
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			
			<div class="row">
				<div class="col-sm-12">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span><?php echo $totalprice?></span></li>
							<li>GST Tax 2%<span><?php echo $totalprice*2/100?></span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span><?php echo $totalprice+$totalprice*2/100?></span></li>
						</ul>
							<a class="btn btn-default update" href="checkout.php">Check Out</a>
							<a class="btn btn-default update" href="index.php">Continue Shopping</a>
							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->


<?php
	require('footer.inc.php');
?>