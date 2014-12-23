<?php 
	require('../connect.php');
	if (isset($_GET['sub_id'])) {
		$id = $_GET['sub_id'];
		$query = "DELETE FROM subtask WHERE sub_id = $id;";
		$prep = $db->prepare($query);
		$prep->execute();
		echo "POST deleted";
	} else {
		echo "No post selected";
	}
