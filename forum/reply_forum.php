<?php

include('connect.php');

if(isset($_GET['sub_id'])){
	$id = $_GET['sub_id'];
	$query = "SELECT * FROM subTask WHERE sub_id = '$id';";
	$prep = $db->prepare($query);
	$prep->execute();
	$results = $prep->fetchAll(PDO::FETCH_ASSOC);
	foreach($results as $result){
		$name = $result['name'];
		$task_id = $result['task_id'];
		echo $result['name'];
		echo "<br/>";
		echo $result['content'];
		echo "<br/>";
	}
} else {
	echo "No Post Selected!";
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$message = $_POST['message'];
	$parent_id = $_POST['parent_id'];
	$task_id = $_POST['task_id'];
	$query = "INSERT INTO subTask (task_id, sub_parent, content) VALUES ('$task_id', '$parent_id', '$message');";
	$prep = $db->prepare($query);
	$prep->execute();
}

?>

<form method="POST" action="reply_forum.php">
	<p>Title: Re: <?= $name ?></p>
	<p>Enter Message</p>
	<textarea cols="50" name="message"></textarea>
	<input type="hidden" value="<?= $id ?>" name="parent_id">
	<input type="hidden" value="<?= $task_id ?>" name="task_id">
	<input type="submit" value="Submit">
</form>