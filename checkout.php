<?php
	require('header.inc.php');
	if(!isset($_SESSION['cart']) || count($_SESSION['cart'])==0){
	?>
	<script>
		window.location.href="index.php";
	</script>
	<?php
	}
?>

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="index.php">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->
			
			<?php
				if(isset($_SESSION['USERLOGIN']) && $_SESSION['USERLOGIN']=='yes'){
					?>
					<div class="step-one">
						<h2 class="heading1">Step1</h2>
					</div>
					
			<div class="step-one">
				<h2 class="heading">Step2</h2>
			</div>

			<div class="shopper-informations">
				<div class="row">
					
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Billing Address</p>
							<div class="form-one">
								<form method="post">
									<input type="text" id="fname" placeholder="First Name *">
									<div class="error" style="color:red;" id="fname_error"></div>
									<input type="text" id="lname" placeholder="Last Name *">
									<div class="error" style="color:red;" id="lname_error"></div>
									<input type="text" id="email" placeholder="Email*">
									<div class="error" style="color:red;" id="email_error"></div>
									<input type="text" id="title" placeholder="Title">
									<input type="text" id="faddress" placeholder="Address 1 *">
									<div class="error" style="color:red;" id="faddress_error"></div>
									<input type="text" id="laddress" placeholder="Address 2">
								</form>
							</div>
							<div class="form-two">
								<form method="post">
									<input type="text" id="zip" placeholder="Zip / Postal Code *">
									<div class="error" style="color:red;" id="zip_error"></div>
									<select id="country">
										<option>-- Country --</option>
										<option>United States</option>
										<option>Bangladesh</option>
										<option>UK</option>
										<option>India</option>
										<option>Pakistan</option>
										<option>Ucrane</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>
									<input type="text" id="state" placeholder="-- State / Province / Region --">
									<input type="text" id="ph"  placeholder="Phone *">
									<div class="error" style="color:red;" id="ph_error"></div>
									<input type="text" id="mobile" placeholder="Mobile Phone">
									<input type="text" id="fax" placeholder="Fax">
								</form>
							</div>
						</div>
					</div>					
				</div>
			</div>
			
			
			<div class="step-one">
				<h2 class="heading">Step3</h2>
			</div>
			
			<div class="review-payment">
				<h2>Review & Payment</h2>
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
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td><?php echo $totalprice?></td>
									</tr>
									<tr>
										<td>GST Tax 2%</td>
										<td><?php echo $totalprice*2/100?></td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span><?php echo $totalprice+$totalprice*2/100?></span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			
			</div>
			<div class="payment-options">
					<form method="post">
					<span>
						<label><input type="radio" value="COD" name="pay" id="pay" required> C.O.D</label>
					</span>                                   
					<span>                                    
						<label><input type="radio" value="Direct Bank Transfer" name="pay" id="pay" required> Direct Bank Transfer</label>
					</span>                                   
					<span>                                    
						<label><input type="radio" value="Paypal" name="pay" id="pay" required> Paypal</label>
					</span>
					<div class="error" style="color:red;" id="payment_error"></div>
					</br>
					</form>
					<button type="submit" onclick="order(<?php echo $_SESSION['USER_ID']?>,<?php echo $totalprice+$totalprice*2/100?>)" class="btn login">Submit</button>
				</div>
					
					<?php
				}else{
					?>
					<div class="step-one">
						<h2 class="heading">Step1</h2>
					</div>
					
					<div class="row">
						<div class="col-sm-4 col-sm-offset-1">
							<div class="login-form"><!--login form-->
								<h2>Login to your account</h2>
								<form method="post">
									<input type="text" id="login_name" placeholder="Name/Email" />
									<input type="password" id="login_password" placeholder="password" />
									<div id="login_error" style="color:red"></div>
								</form>
								<button type="submit" onclick="login_user()" class="btn login">Login</button>
							</div><!--/login form-->
						</div>
						<div class="col-sm-1">
							<h2 class="or">OR</h2>
						</div>
						<div class="col-sm-4">
							<div class="signup-form"><!--sign up form-->
								<h2>New User Signup!</h2>
								<form method="post">
									<input type="text" id="signup_name" placeholder="Name" required/>
									<input type="email" id="signup_email" placeholder="Email Address" required/>
									<input type="password" id="signup_pssword" placeholder="Password" required/>
									<div id="signup_error" style="color:red"></div>
									<button type="submit" onclick="signup_user()" class="btn btn-default">Signup</button>
								</form>
							</div><!--/sign up form-->
						</div>
					</div>
					
					<div class="step-one">
						<h2 class="heading">Step2</h2>
					</div>
					<div class="step-one">
						<h2 class="heading">Step3</h2>
					</div>
					<?php
				}
			?>	
		</div>
	</section> <!--/#cart_items-->

	

<?php
	require('footer.inc.php');
?>
