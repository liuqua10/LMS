<?php 
	include ("common.php");
	top();
?> 


				<form class = "loginform" id="loginform" action="login.php" method="post">
					<h1>Welcome Earthlings</h1>
					<div class="signup">Don't have an account?&thinsp;<a href="signup_page.php">Sign up!</a></div>
					<div class = "enter username"><input name="username/Email" type="text" size="30" autofocus="autofocus" placeholder="Username/Email" /></div>
					<div class = "enter password"><input name="password" type="password" size="30" placeholder= "Password" /></div>
					<div class = "forget">Forget <a href="retrieve_page.php">username/password?</a></div>
					<div class = "stay"><input type = "checkbox"/>Stay sign in</div>
					<div class = "loginbtn"><input class = "btn" type="submit" value="Log in" /></div>
				</form>
			</div>
	</body>
</html>