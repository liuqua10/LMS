<?php 
	include ("common.php");
	top();
?> 

		<form class = "loginform" id="retrieveform" action="signup.php" method="post">
			<h1>Where are my precious?</h1>
			<h3 class="info">Please enter your email address:</h3>
			<p class="back"><a href="login_page.php">Back to login page</a></p>
			<div class = "textbox"><input name="Email" type="text" size="30"  placeholder="Email"/></div>
			<div class = "signupbtn"><input class = "btn" type="submit" value="Reset Password" /></div>
		</form>
	</body>
</html>