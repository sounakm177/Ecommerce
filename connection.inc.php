<?php
	session_start();

	$conn=mysqli_connect('localhost','root','','e-com1');
	if(!$conn){
		die("SERVER FAILED");
	}

?>