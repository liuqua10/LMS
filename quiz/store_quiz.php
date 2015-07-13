<?php

require('../connect.php');

if(isset($_POST)){
	$name = $_POST['quizName'];
	var_dump($name);
	$questions = $_POST['questions'];
	$answers = $_POST['answers'];
	$query = "INSERT INTO task (name, detail, type) VALUES ('$name', '$questions', 'q');";
	$prep = $db->prepare($query);
	$prep->execute();
	$query = "SELECT * FROM task WHERE detail = '$questions' LIMIT 1;";
	$prep = $db->prepare($query);
	$prep->execute();
	$results = $prep->fetch(PDO::FETCH_ASSOC);
	$quiz_id = $results['task_id'];
	echo $quiz_id;
	$query = "INSERT INTO subTask (task_id, name, content, type) VALUES ('$quiz_id', '$name', '$answers', 'a')";
	$prep = $db->prepare($query);
	$prep->execute();
	echo 'Quiz Added!';
}

?>