/**********************************************
***************Coustom Code In JQUEry**********
***********************************************/
	//contact us send message code 
	
	function send_message(){
		var name=$('#name').val();
		var email=$('#email').val();
		var subject=$('#subject').val();
		var message=$('#message').val();
		if(name==''){
			$('#error').text('***Plece Enter your Name !!');
		}else if(email==''){
			$('#error').text('***Plece Enter your Email !!');
		}else if(subject==''){
			$('#error').text('***Plece Enter your Subject !!');
		}else if(message==''){
			$('#error').text('***Plece Enter your Message !!');
		}else{
			$.ajax({
				url:'send_message.php',
				type:'post',
				data:{
					name,
					email,
					subject,
					message
				},
				success:function(result){
					$("input").val("");
					$('#message').val("");
				}
			});
		}
	}
	
	
	// ...............cart js ............//
	
	function manage_cart(pid,type){
		
		if(type=='update'){
			var qty=$("#"+pid+"qty").val();
		}else{
			var qty=$('#qty').val();
		}
		$.ajax({
					url:'set_cart.php',
					type:'post',
					data:{
						pid,
						qty,
						type
					},
					success:function(data){
						if(type=='update' || type=='remove'){
							window.location.href=window.location.href;
						}
						
					}
				});
		
	}
	
	
	//login function 
	function login_user(){
		var name=$('#login_name').val();
		var password=$('#login_password').val();
		var oparation="login";
		if(name==''){
			$('#login_error').text("****Enter Name/Email !!");
		}else if(password==""){
			$('#login_error').text("****Enter Password !!");
		}else{
			$.ajax({
				url:'login_submit.php',
				type:'post',
				data:{
					name,
					password,
					oparation
				},
				success:function(result){
					if(result.trim()=='success'){
						$('input').val("");
						window.location.href=window.location.href;
					}else{
						$('input').val("");
					}
				}
			});
		}
	}
	
	//signup function
	function signup_user(){
		var name=$('#signup_name').val();
		var email=$('#signup_email').val();
		var password=$('#signup_pssword').val();
		var oparation="signup";
		if(name==''){
			$('#signup_error').text("****Enter Name !!");
		}else if(email==""){
			$('#signup_error').text("****Enter Email !!");
		}else if(password==""){
			$('#signup_error').text("****Enter Password !!");
		}else{
			$.ajax({
				url:'login_submit.php',
				type:'post',
				data:{
					name,
					email,
					password,
					oparation
				},
				success:function(result){
					if(result.trim()=='signup'){
						$('input').val("");
						alert("please login");
						window.location.href=window.location.href;
					}else{
						alert("Alredy Resiter !!");
						$('input').val("");
					}
				}
			});
		}
		
	}
	
	//order place function create 
	function order(uid,total_price){
		var fname=$('#fname').val();
		var lname=$('#lname').val();
		var email=$('#email').val();
		var country=$('#country').val();
		var title=$('#title').val();
		var faddress=$('#faddress').val();
		var laddress=$('#laddress').val();
		var zip=$('#zip').val();
		var state=$('#state').val();
		var ph=$('#ph').val();
		var mobile=$('#mobile').val();
		var fax=$('#fax').val();
		var pay=$('#pay').val();
		if(fname==''){
			$('#fname_error').text("****Enter First Name !!");
		}else if(lname==''){
			$('.error').text("");
			$('#lname_error').text("****Enter Last Name !!");
		}else if(email==''){
			$('.error').text("");
			$('#email_error').text("****Enter Email !!");
		}else if(faddress==''){
			$('.error').text("");
			$('#faddress_error').text("****Enter Address 1 !!");
		}else if(zip==''){
			$('.error').text("");
			$('#zip_error').text("****Enter ZIP !!");
		}else if(ph==''){
			$('.error').text("");
			$('#ph_error').text("****Enter Phone !!");
		}else if(pay==''){
			$('.error').text("");
			$('#payment_error').text("****Enter Payment Type !!");
		}else{
			$('.error').text("");
			$.ajax({
				url:'order_submit.php',
				type:'post',
				data:{
					uid,
					total_price,
					fname,
					lname,
					email,
					title,
					country,
					faddress,
					laddress,
					zip,
					state,
					ph,
					mobile,
					fax,
					pay
				},
				success:function(data){
					if(data.trim()=='success'){
						window.location.href="thank.php";
					}else{
						window.location.href="checkout.php";
					}
				}
			});
		}
	} 
	
	//wishlist remove button jquery code
	function wishlist_remove(pid,uid){
		$.ajax({
			url:'delete_wishlist.php',
			type:'post',
			data:{
				pid,
				uid
			},
			success:function(data){
				if(data.trim()=='success'){
					window.location.href="wishlist.php";
				}else{
					window.location.href="logout.php";
				}
			}
		});
	}
	
	//order_delete function
	function order_delete(order_id,product_id){
		$.ajax({
			url:'my_order.php',
			type:'post',
			data:{
				order_id,
				product_id
			},
			success:function(){
				window.location.href=window.location.href;
			}
		});
	}