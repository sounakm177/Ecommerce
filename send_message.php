<?php
	require('connection.inc.php');
	require('function.inc.php');
	
	
		if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])){
			
			$name=get_value($conn,$_POST['name']);
			$email=get_value($conn,$_POST['email']);
			$subject=get_value($conn,$_POST['subject']);
			$message=get_value($conn,$_POST['message']);
			$added_on=date('Y-m-d h:i:s');
			$contact_sql="insert into contact_us (name,email,subject,comment,added_on)
							values('$name','$email','$subject','$message','$added_on')";
			mysqli_query($conn,$contact_sql);
		}
	

?>