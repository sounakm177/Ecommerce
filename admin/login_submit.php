<?php
	require('connection.inc.php');
	require('function.inc.php');
	
	if(isset($_POST['username']) && isset($_POST['pass'])){
		$username=$_POST['username'];
		$pass=$_POST['pass'];
		
		$sql="select * from admin_users where username='$username' and password='$pass'";
		$result=mysqli_query($conn,$sql);
		$check=mysqli_num_rows($result);
		if($check>0){
			$_SESSION['ADMIN_LOGIN']='YES';
			$_SESSION['ADMIN_USERNAME']=$username;
			echo 'valid';
		}else{
			echo 'invalid';
		}
		
	}
?>