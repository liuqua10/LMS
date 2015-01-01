<?php 
	include ("common.php");
	top();
?> 


				<form class = "loginform" id="loginform" action="login.php" method="post">
					<div class="signup">Don't have an account?<a href="sign_up_page.php">Sign up!</a></div>
					<div class = "enter username"><input name="username/Email" type="text" size="30" autofocus="autofocus" placeholder="Username/Email" /></div>
					<div class = "enter password"><input name="password" type="password" size="30" placeholder= "Password" /></div>
					<div class = "forget">Forget <a href="retrieve.php">username?</a> <a href="retrieve.php">password?</a></div>
					<div><input type = "checkbox"/>Stay sign in</div>
					<div class = "login"><input class = "btn" type="submit" value="Log in" /></div>
				</form>
			</div>
		</body>
	</html>