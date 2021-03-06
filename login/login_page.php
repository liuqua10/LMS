<!DOCTYPE html>
<html>

<head>
    <title>Please Signup </title>
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
    <!-- Angular js -->
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
    <!-- Validation js -->
    <script src="app.js"></script>
</head>

<body class="register index">

    <div class="container">

        <!-- PAGE HEADER -->
        <div class="page-header row">
            <h1>Please Login</h1>
            <h5><? if (isset($_GET['status'])){ echo "Incorrect password or username";} ?></h5>

        </div>


        <!-- ============FORM================ -->


      <!-- pass in the variable if form is valid or invalid -->
        <form ng-app="myApp" ng-controller="validateCtrl" method="post" action="login.php" name="myForm" novalidate>


            <!-- USERNAME -->
            <div class="form-group" required>
                <label>Username</label>
                <input type="text" name="user" ng-model="user" class="form-control" required>
                <span style="color:red" ng-show="myForm.user.$dirty && myForm.user.$invalid">
                <span ng-show="myForm.user.$error.required">Username is required.</span>
                </span>
            </div>


            <!-- PASSWORD -->
            <div class="form-group" required>
                <label>Password (between 3 to 8 charaters)</label>
                <input type="password" name="password" class="form-control" ng-model="password" ng-minlength="3" ng-maxlength="8">
                <span style="color:red" ng-show="myForm.password.$dirty && myForm.password.$invalid">
                <span ng-show="myForm.password.$error.required">Password is required.</span>
                <span ng-show="myForm.password.$error.minlength">Password is too short.</span>
                <span ng-show="myForm.password.$error.maxlength">Password is too long.</span>
                </span>
            </div>



              <!-- Submit -->
            <button type="submit" class="btn btn-primary">Submit</button>
						<button class="btn" onclick="location.href='signup_page.php'">Sign up</button>

        </form>
</body>

</html>
