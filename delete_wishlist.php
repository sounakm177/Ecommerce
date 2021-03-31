<?php
	require('connection.inc.php');
	require('function.inc.php');
	
	$count=0;
	if(isset($_POST['pid']) && isset($_POST['uid']) && $_POST['pid']!='' && $_POST['uid']!=''){
		$pid=get_value($conn,$_POST['pid']);
		$uid=get_value($conn,$_POST['uid']);
		$check_result=mysqli_query($conn,"select * from users where id='$uid'");
		if(mysqli_num_rows($check_result)>0){
			$count=1;
			$check_result=mysqli_query($conn,"select * from product where id='$pid'");
			if(mysqli_num_rows($check_result)>0){
				$count=2;
			}
		}
	}
	
	if($count==2){
		$delete_wishlist_sql="delete from wishlist where user_id='$uid' and product_id='$pid'";
		if(mysqli_query($conn,$delete_wishlist_sql)){
			echo "success";
		}else{
			echo "not success";
		}
	}else{
		echo "Not Access";
	}
?>