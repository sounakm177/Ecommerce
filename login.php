<?php
	require('header.inc.php');
?>

<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form method="post">
							<input type="text" id="login_name" placeholder="Name/Email" />
							<input type="password" id="login_password" placeholder="password" />
							<div id="login_error" style="color:red"></div>
							
						</form>
						<button type="submit" onclick="login_user()" class="btn login">Login</button>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form method="post">
							<input type="text" id="signup_name" placeholder="Name" required/>
							<input type="email" id="signup_email" placeholder="Email Address" required/>
							<input type="password" id="signup_pssword" placeholder="Password" required/>
							<div id="signup_error" style="color:red"></div>
							<button type="submit" onclick="signup_user()" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

<?php
	require('footer.inc.php');
?>