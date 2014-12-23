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
		$content = $result['content'];
	}	
} else if (isset($_POST['sub_id'])){
	$id = $_POST['sub_id'];
	$name = $_POST['title'];
	$content = $_POST['content'];
	$query = "UPDATE subTask SET name = '$name', content = '$content' WHERE sub_id = '$id';";
	$prep = $db->prepare($query);
	$prep->execute();
	echo "Updated!";	

} else {
	echo "NO POST SELECTED!";
}

?>

<form action="edit_forum.php" method="POST">
	<p>Title: <input type="text" value= "<?= $name ?>" name="title" ></p>
	<p>Message: <textarea name="content"><?= $content?></textarea> </p>
	<input type="hidden" name="sub_id" value="<?= $id ?>">
	<input type="submit" value="Submit">
</form>