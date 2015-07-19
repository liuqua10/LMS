<?php

require('login_classes.php');
require('../database.php');

$db = new Database();
$first = $_POST['first_name'];
$last = $_POST['last_name'];
$user = $_POST['user'];
$pass = $_POST['password'];
$email = $_POST['email'];

new create_user($first, $last, $user, $pass, $email, $db);


 ?>
