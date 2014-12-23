<?php

include('connect.php');

if(isset($_GET['sub_id'])){
	$id = $_GET['sub_id'];
	$query = "DELETE FROM subTask WHERE sub_id = '$id'";
	$prep = $db->prepare($query);
	$prep->execute();
	echo "POST DELETED!";
} else {
	echo "NO POST SELECTED!";
}

?>