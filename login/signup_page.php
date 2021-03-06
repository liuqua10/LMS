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
            <h1>Please Enter Information Below</h1>
            <h5><? if (isset($_GET['status'])){ echo "Username taken, please select another";} ?></h5>
        </div>


        <!-- ============FORM================ -->


      <!-- pass in the variable if form is valid or invalid -->
        <form ng-app="myApp" ng-controller="validateCtrl" name="myForm" method="post" action="signup.php" novalidate>
            <!-- FIRST NAME -->
            <div class="form-group" required>
                <label>First Name</label>
                <input type="text" name="first_name" ng-model="first_name" class="form-control" required>
                <span style="color:red" ng-show="myForm.first_name.$dirty && myForm.first_name.$invalid">
                <span ng-show="myForm.first_name.$error.required">First name is required.</span>
                </span>
            </div>

            <!-- LAST NAME -->
            <div class="form-group" required>
                <label>Last Name</label>
                <input type="text" name="last_name" ng-model="last_name" class="form-control" required>
                <span style="color:red" ng-show="myForm.last_name.$dirty && myForm.last_name.$invalid">
                <span ng-show="myForm.last_name.$error.required">Last name is required.</span>
                </span>
            </div>

            <!-- USERNAME -->
            <div class="form-group" required>
                <label>Username</label>
                <input type="text" name="user" ng-model="user" class="form-control" required>
                <span style="color:red" ng-show="myForm.user.$dirty && myForm.user.$invalid">
                <span ng-show="myForm.user.$error.required">Username is required.</span>
                </span>
            </div>

            <!-- EMAIL -->
            <div class="form-group" required>
                <label>Email</label>
                <input type="email" name="email" class="form-control" ng-model="uemail">
                <span style="color:red" ng-show="myForm.email.$dirty && myForm.email.$invalid">
                <span ng-show="myForm.email.$error.required">Email is required.</span>
                <span ng-show="myForm.email.$error.email">Invalid email address.</span>
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


        </form>
</body>

</html>
