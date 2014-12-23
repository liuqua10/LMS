<?php
	include('connect.php');
	if (isset($_GET['task_id'])){
		$id = $_GET['task_id'];
		$query = "SELECT * FROM subTask WHERE task_id = '$id' AND sub_parent = '0';";
		$prep = $db->prepare($query);
		$prep->execute();
		$results = $prep->fetchAll(PDO::FETCH_ASSOC);
		foreach($results as $result){
			echo $result['name'];
			echo '<br/>';
			echo $result['content'];
			echo '<br/>';
			echo "<a href='edit_forum.php?sub_id=".$result['sub_id']."'>Edit</a> ";
			echo "<a href='delete_forum.php?sub_id=".$result['sub_id']."'>Delete</a> ";
			echo "<a href='reply_forum.php?sub_id=".$result['sub_id']."'>Reply</a> ";
			echo "<br/>";
			display_reply($result['sub_id']);
		}
	} else {
		$query = "SELECT * FROM task WHERE type = 'f';";
		$prep = $db->prepare($query);
		$prep->execute();
		$results = $prep->fetchAll(PDO::FETCH_ASSOC);
		foreach($results as $result){
			echo '<a href="view_forum.php?task_id='.$result['task_id'].'">'.$result['name'].'</a>';
		}
	}

function display_reply($sub_id){
	global $db;
	$query = "SELECT * FROM subTask WHERE sub_parent = '$sub_id';";
	$prep = $db->prepare($query);
	$prep->execute();
	$results = $prep->fetchAll(PDO::FETCH_ASSOC);
	foreach($results as $result){
		echo "<blockquote>".$result['content'];
		echo "<br/>";
		echo "<a href='edit_forum.php?sub_id=".$result['sub_id']."'>Edit</a> ";
		echo "<a href='delete_forum.php?sub_id=".$result['sub_id']."'>Delete</a> ";
		echo "<a href='reply_forum.php?sub_id=".$result['sub_id']."'>Reply</a> ";
		echo "</blockquote>";
		echo "<br/>";
		echo "<blockquote>".display_reply($result['sub_id'])."</blockquote>";
	}
}
