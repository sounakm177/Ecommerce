<?php
	
	require('connection.inc.php');
	require('function.inc.php');
	
	$login=0;
	$signup=0;
	
	if(isset($_POST['oparation'])){
		$oparation=get_value($conn,$_POST['oparation']);
		if($oparation=='login'){
			$login=1;
		}else{
			$signup=1;
		}
	}
		
	//login code
	if($login==1){
		if(isset($_POST['name']) && $_POST['name']!=''){
			$name=get_value($conn,$_POST['name']);
			if(isset($_POST['password']) && $_POST['password']!=''){
				$password=get_value($conn,$_POST['password']);
				$check_sql="select * from users where name='$name'
							and password='$password' or email='$name'";
				$check_result=mysqli_query($conn,$check_sql);
				if(mysqli_num_rows($check_result)>0){
					$row=mysqli_fetch_assoc($check_result);
					$_SESSION['USERLOGIN']='yes';
					$_SESSION['USERNAME']=$row['name'];
					$_SESSION['USER_ID']=$row['id'];
					echo "success";
				}else{
					echo "unsuccess";
				}
			}
		}
	}
	
	//signup code 
	if($signup==1){
		if(isset($_POST['name']) && $_POST['name']!=''){
			$name=get_value($conn,$_POST['name']);
			if(isset($_POST['password']) && $_POST['password']!=''){
				$password=get_value($conn,$_POST['password']);
				if(isset($_POST['email']) && $_POST['email']!=''){
					$email=get_value($conn,$_POST['email']);
					$check_sql="select * from users where name='$name' and email='$email'";
					$check_result=mysqli_query($conn,$check_sql);
					if(mysqli_num_rows($check_result)>0){
						
					}else{
						$added_on=date('Y-m-d h:i:s');
						$signup_sql="insert into users(name,email,password,added_on)
										values('$name','$email','$password','$added_on')";
						mysqli_query($conn,$signup_sql);
						echo "signup";
					}
				}
			}
		}
	}
	
?>