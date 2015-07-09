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
        <div class="page-header">
            <h1>Please Enter Information Below</h1>
        </div>


        <!-- ============FORM================ -->


      <!-- pass in the variable if form is valid or invalid -->
        <form ng-app="myApp" ng-controller="validateCtrl" name="myForm" novalidate>
            <!-- NAME -->
            <div class="form-group" required>
                <label>Name</label>
                <input type="text" name="name" ng-model="name" class="form-control" required>
                <span style="color:red" ng-show="myForm.name.$dirty && myForm.name.$invalid">
                <span ng-show="myForm.name.$error.required">Name is required.</span>
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
            <button type="submit" class="btn btn-primary">Submit</button>


        </form>
</body>

</html>
