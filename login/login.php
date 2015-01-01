<?php
	
?>


<form action ="signup-submit.php" method="post">
			<fieldset>
				<legend>New User Signup:</legend>
				<div>
					<strong>Name:</strong> 
					<input type="text" size="16" name="accountname" />
				</div>
				
				<div>
				<strong>Gender:</strong> 
					<label><input type="radio" name="gender" value="M" /> Male</label>
					<label><input type="radio" name="gender" value="F" checked="checked" /> Female</label>
				</div>
				
				<div>
				<strong>Age:</strong> 
					<input type="text" size="6" maxlength="2" name="age" />
				</div>
				
				<div>
					<strong>Personality type:</strong>
					<input type="text" size="6" maxlength="4" name="personality"/>
					(<a href="http://www.humanmetrics.com/cgi-win/JTypes2.asp"/>Don't know your type?</a>)
				</div>

				<div>
				<strong>Favorite OS:</strong>
				<select name="favoriteOS">
					<option select="selected">Windows</option>
					<option>Mac OS X</option>
					<option>Linux</option>
				</select>
				</div>
				
				<div>
				<strong>Seeking age:</strong>
					<input type="text" size="6" maxlength="2" name="min" placeholder="min"/>
					to
					<input type="text" size="6" maxlength="2" name="max" placeholder="max"/>
				</div>
				<div>
					<input type="submit" value="Sign Up"/>
				</div>
			</fieldset>
		</form>