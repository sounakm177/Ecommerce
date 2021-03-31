<?php

	function prx($arr){
		echo "<pre>";
		print_r($arr);
		die();
	}
	
	function get_value($conn,$srt){
		if($srt!=''){
			$srt=trim($srt);
			return mysqli_real_escape_string($conn , $srt);
		}
	}
?>