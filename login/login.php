<?php

require('login_classes.php');
require('../database.php');

$db = new Database;
$user = $_POST['user'];
$password = $_POST['password'];


new login($user, $password, $db);

?>
