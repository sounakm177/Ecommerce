/*
  ===========================================
			jquery===========================
  ===========================================
*/
$(document).ready(function(){
	
	//register code
	$('#register_show').click(function(){
		$('#login').hide();
		$('.register').show();
	});
	
	//plugin datatable from boostrup  
	 $('#dataTable').DataTable(); // ID From dataTable 
     $('#dataTableHover').DataTable(); // ID From dataTable with Hover
	
});

/*
  ===========================================
			Javescript Function =============
  ===========================================
*/

// login function 
function login_btn(){
	var username = $('#username').val();
	var pass = $('#pass').val();
				
	if(username==''){
		$('.focus-input100').html('place Enter username');
	}else if(pass==''){
		$('.focus-input100').html('place Enter Password');
	}
	$.ajax({
		url:'login_submit.php',
		type:'post',
		data:{
			username,
			pass
		},
		success:function(result){
			if(result.trim()=='valid'){
				$('input').val('');
				window.location.href='index.php';
			}else{
				$('input').val('');
			}
		}
	});
}

/*
==================================
	categories script
===================================
*/
	