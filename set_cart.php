<?php
	require('connection.inc.php');
	require('function.inc.php');
	require('add_to_cart.php');
	
	$pid=get_value($conn,$_POST['pid']);
	$qty="1";
	if(isset($_POST['qty'])){
		
		$qty=get_value($conn,$_POST['qty']);
	}
	
	$type=get_value($conn,$_POST['type']);
	
	$ob=new add_to_cart();
	
	if($type=='add'){
		$ob->addProduct($pid,$qty);
	}
	
	if($type=='remove'){
		$ob->removeProduct($pid);
	}
	
	if($type=='update'){
		$ob->updateProduct($pid,$qty);
	}
	
	echo $ob->totalProduct();
?>