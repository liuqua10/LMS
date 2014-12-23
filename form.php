<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
						
<?php 
	require('../connect.php');
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$title = $_POST['title'];
		$message = $_POST['message'];
		$query = "INSERT INTO subtask (task_id, name, content, type) VALUES ('1', '$title', '$message','r');";
		$prep = $db->prepare($query);
		$prep->execute();
	}
?>

<form method="POST" action="forum.php">
	<p>Enter Title</p>
	<input type="text" name ="title">
	<p>Enter message</p>
	<textarea cols="100" name="message"></textarea>
	<input type="submit" value="submit">
</form>



