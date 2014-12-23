<?php 
	require('../connect.php');
	if(isset($_GET['sub_id'])) {
		$id = $_GET['sub_id'];
		$query = "SELECT * FROM subtask WHERE sub_id = '$id';";
		$prep = $db->prepare($query);
		$prep->execute();
		$results = $prep->fetchAll(PDO::FETCH_ASSOC);
		foreach($results as $result) {
			$name = $result['name'];
			$task_id = $result['task_id'];
			echo $result['name'];
			echo "<br/>";
			echo $result['content'];
		}
	} else {
		echo "No Post is chosen!";
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$message = $_POST['content'];
		$parent_id = $_POST['parent_id'];
		$task_id = $_POST['task_id'];
		$query = "INSERT INTO subtask (task_id, sub_parent, content) VALUES ('$task_id','$parent_id','$message');";
		$prep = $db->prepare($query);
		$prep->execute();
	}
?> 

<form action = "reply_forum.php" method = "POST"> 
	<p>Title: RE: <?= $name ?></p>
	<p>Message: <textarea name = "content"></textarea></p>
	<input type = "hidden" name = "parent_id" value = "<?= $id ?>">
	<input type = "hidden" name = "task_id" value = "<?= $task_id ?>">
	<input type="submit" value = "Submit">
</from> 
