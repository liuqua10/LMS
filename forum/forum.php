<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
<?php 

include('connect.php');
if ($_SERVER['REQUEST_METHOD'] == "POST"){
	global $db;
	$title = htmlentities($_POST['title']);
	$message = htmlentities($_POST['message']);
	$query = "INSERT INTO subTask (task_id, name, content, type) VALUES ('1', '$title', '$message', 'r');";
	echo $query;
	$prep = $db->prepare($query);
	$prep->execute();
}
?>
<form method="POST" action="forum.php">
	<p>Enter Title</p>
	<input type="text" name="title">
	<p>Enter Message</p>
	<textarea cols="200" name="message"></textarea>
	<input type="submit" value="Submit">
</form>
