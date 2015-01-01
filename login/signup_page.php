<?php
	include ("common.php");
	top();
?>
		<form class = "loginform" id="signupform" action="signup.php" method="post">
			<h1>Welcome Earthlings</h1>
			<h3 class="info">Please enter your information below:</h3>
			<p class="back"><a href="login_page.php">Back to login page</a></p>
			<div class = "textbox"><input name="name" type="text" size="30" autofocus="autofocus" placeholder="Name" /></div>
			<div class = "textbox"><input name="username" type="text" size="30"  placeholder="Username" /></div>
			<div class = "textbox"><input name="Email" type="text" size="30"  placeholder="Email"/></div>
			<div class = "textbox"><input name="password" type="password" size="30" placeholder= "Password" /></div>
			<div class = "textbox"><input name="School" type="text" size="30" placeholder= "Your School" /></div>
			<div class = "textbox"><input name="Identification number" type="text" size="30" placeholder= "Your ID number" /></div>
			<div class = "signupbtn"><input class = "btn" type="submit" value="Sign Up" /></div>
		</form>
	</body>
</html>