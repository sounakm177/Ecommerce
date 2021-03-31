<?php
	require('connection.inc.php');
	require('function.inc.php');
	
	unset($_SESSION['USERLOGIN']);
	unset($_SESSION['USERNAME']);
	unset($_SESSION['USER_ID']);
	header('location:login.php');
	die();
?>