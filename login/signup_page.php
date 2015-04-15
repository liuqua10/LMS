<!DOCTYPE html>
<!--[if lte IE 9 ]> <html class="ie9" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-us"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en-us"> <!--<![endif]-->
    <head>
        
                <title>Please login </title>

                <link rel="stylesheet" type="text/css" media="screen" href="home.css" />

        <script type="text/javascript" src="//use.typekit.net/gwl2ttn.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
        <script type="text/javascript" src="https://d2zruwytl6b6e6.cloudfront.net/js/cache/marketing-vendor.239e349b.js"></script>
        <script type="text/javascript" src="https://d2zruwytl6b6e6.cloudfront.net/js/marketing.js"></script>


      
    </head>

<body class="register index">

<div class="page-wrap">
	<div class="static-form">
		<form class = "loginform" id="signupform" action="signup.php" method="post">

			<h2>Welcome Earthlings</h2>
			<h3 class="info">Please enter your information below:</h3>
			<p class="back"><a href="login_page.php">Back to login page</a></p>
			 <div class="form-field">
                                <input type="text" name="fullName" id="fullName" value="" placeholder="Full name" maxlength="100" />                <input type="hidden" name="txtFname" id="txtFname" value="" maxlength="100" />                <input type="hidden" name="txtLname" id="txtLname" value="" maxlength="100" />                                            </div>

            <div class="form-field">
                <input type="text" name="username" id="username" value="" placeholder="username" />                                             
            </div>

            <div class="form-field">
                <input type="text" name="txtEmail" id="txtEmail" value="" placeholder="Email" />                                                
            </div>

            <div class="form-field">
                <input type="password" name="txtPassword" id="txtPassword" value="" placeholder="Password" maxlength="25" />                <div id="divPassword" class="errMessage"></div>
                <div id="divLenPassword" class="errMessage"></div>
			</div>

			<div class = "form-field">
				<input name="School" type="text" size="30" placeholder= "Your School" />
			</div>

			<div class = "form-field">
				<input name="Identification number" type="text" size="30" placeholder= "Your ID number" />
			</div>
			
			<div class="form-field checkboxes">
                <label class="checkbox" for="chkTerm">
                    <input id="chkTerm" name="chkTerm" type="checkbox" />
                    I agree to the
                    <a title="Terms of Use" href="/terms" target="_blank">Terms of Use</a> and
                    <a title="Privacy Policy" href="/privacy" target="_blank">Privacy Policy</a>.
                </label>
            </div>
			<p>Please select the baby seal</p>
			<div class = "animals">
				<img class = "animal" src="puppy.jpg" alt = "puppy"  width="75">
				<img class = "animal" src="kitten.jpg" alt = "kitten"  width="75">
				<img class = "animal" src="seal.jpg" alt = "seal"  width="75">

			</div>
			<div class = "form-field">
				<input class = "btn btn-lg btn-primary" type="submit" value="Sign Up" />
			</div>

		</form>
	</div>
</div>

<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        mixpanel.track('registration_page');
        $('form input[type="text"], textarea').first().focus();

        $.validator.addMethod(
            'regex',
            function(value, element, regexp) {
                var check = false;
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            'Please use only upper and lowercase letters here.'
        );

        var validation = $('#signupform').validate({
            messages: {
                fullName: {
                    required: 'Please enter your full name.',
                    maxlength: 'Name cannot be more than 100 characters.',
                    regex: 'Please enter both your first and last names.'
                },

                txtEmail: {
                    required: 'Please enter your e-mail address.',
                    email: 'Please enter a valid e-mail address.'
                },

                txtPassword: {
                    required: 'Please enter a password.',
                    rangelength: 'Please enter a password between 6-20 characters.'
                },

                institution: 'Please enter your institution.'
            },

            rules: {
                fullName: {
                    required: true,
                    maxlength: 100,
                    regex: /^[A-Za-z\s`~!@#$%^&*()+={}|;:'",.<>\/?\\-]+\s[A-Za-z\s`~!@#$%^&*()+={}|;:'",.<>\/?\\-]+$/
                },

                txtEmail: {
                    required: true,
                    email: true
                },

                txtPassword: {
                    required: true,
                    rangelength: [6, 20]
                },

                institution: {
                    required: true
                }
            }
        });
  
</script>
	</body>
</html>
