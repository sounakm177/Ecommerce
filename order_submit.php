<?php
	require('connection.inc.php');
	require('function.inc.php');
	$title='';
	$laddress='';
	$state='';
	$mobile='';
	$fax='';
	$country='';
	$payment_status='pending';
	if(isset($_POST)){
		if(isset($_POST['fname']) && $_POST['fname']!='' && isset($_POST['lname']) && $_POST['lname']!=''){
			$fname=get_value($conn,$_POST['fname']);
			$lname=get_value($conn,$_POST['lname']);
			if(isset($_POST['email']) && $_POST['email']!='' && isset($_POST['faddress']) && $_POST['faddress']!=''){
				$email=get_value($conn,$_POST['email']);
				$faddress=get_value($conn,$_POST['faddress']);
				if(isset($_POST['zip']) && $_POST['zip']!='' && isset($_POST['ph']) && $_POST['ph']!=''){
					$zip=get_value($conn,$_POST['zip']);
					$ph=get_value($conn,$_POST['ph']);
					if(isset($_POST['pay']) && $_POST['pay']!='' && isset($_POST['uid']) && $_POST['uid']!=''  && isset($_POST['total_price']) && $_POST['total_price']!=''){
						$pay=get_value($conn,$_POST['pay']);
						$total_price=get_value($conn,$_POST['total_price']);
						$title=get_value($conn,$_POST['title']);
						$laddress=get_value($conn,$_POST['laddress']);
						$state=get_value($conn,$_POST['state']);
						$mobile=get_value($conn,$_POST['mobile']);
						$fax=get_value($conn,$_POST['fax']);
						$country=get_value($conn,$_POST['country']);
						$uid=get_value($conn,$_POST['uid']);
						if($pay=='cod'){
							$payment_status='success';
						}
						$order_status='1';
						$added_on=date('Y-m-d h:i:s');
						$check_sql="select * from users where id='$uid'";
						$check_result=mysqli_query($conn,$check_sql);
						if(mysqli_num_rows($check_result)>0){
							$order_sql="insert into orders(user_id ,first_name,last_name,email,title,first_address,last_address,zip,country,state,phone,mobile,fax,payment_type,total_price,payment_status,order_status,added_on)
									values('$uid' ,'$fname', '$lname', '$email',
									'$title', '$faddress', '$laddress', '$zip',
									'$country', '$state', '$ph', '$mobile', '$fax',
									'$pay','$total_price','$payment_status','$order_status','$added_on')";
							if(mysqli_query($conn,$order_sql)){
								$order_id=mysqli_insert_id($conn);//whose 'id' insert resent in database, that id return this function.
								foreach($_SESSION['cart'] as $key=>$value){
									$productArr=get_product($conn,'','',$key);
									$price=$productArr[0]['price'];
									$qty=$value['qty'];
									$sql="insert into orders_detail(order_id,product_id,qty,price)
									values('$order_id','$key','$qty','$price')";
									mysqli_query($conn,$sql);
								}
								unset($_SESSION['cart']);
								echo "success";
							}
						}else{
							?>
							<script>
								window.location.href="checkout.php";
							</script>
							<?php
							die();
						}
					}else{
						?>
							<script>
								window.location.href="checkout.php";
							</script>
						<?php
						die();
					}
				}
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
?>