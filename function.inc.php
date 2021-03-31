<?php
	
	function pr($arr){
		echo "<pre>";
		print_r($arr);
	}
	
	function prx($arr){
		echo "<pre>";
		print_r($arr);
		die();
	}
	
	function get_value($conn, $arr){
		if($arr!=''){
			$arr=trim($arr);
			return mysqli_real_escape_string($conn,$arr);
		}
	}
	
	function get_product($conn ,$best='',$limit='',$product_id='', $order='', $cat_id='' ,$search_str=''){
		$sql="select product.*,categories.categories 
		from product,categories where product.status=1 and 
		product.categories_id=categories.id and categories.status=1 "; 
		
		if($search_str!=''){
			$sql.=" and (product.name like '%$search_str%' or product.description like '%$search_str%')";
		}
		
		if($cat_id!=''){
			$sql.=" and product.categories_id = ".$cat_id;
		}
		
		if($product_id!=''){
			$sql.=" and product.id = ".$product_id;
		}
		
		if($best!=''){
			$sql.=" and product.best_seller = ".$best;
		}
		
		if($order=='asc'){
			$sql.=" order by id asc ";
		}else{
			$sql.=" order by id desc ";
		}
		
		if($limit!=''){
			$sql.=" limit ".$limit;
		}
		
		$result=mysqli_query($conn,$sql);
		$data=array();
		while($row=mysqli_fetch_assoc($result)){
			$data[]=$row;
		}
		return $data;
	}
?>