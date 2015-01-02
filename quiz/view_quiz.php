<?php
require('../connect.php');
	$quiz_select = '';
	$query = "SELECT * FROM task WHERE type = 'q';";
	$prep = $db->prepare($query);
	$prep->execute();
	$results = $prep->fetchAll(PDO::FETCH_ASSOC);
	foreach($results as $result){
		$quiz_select .= '<option value="'. $result['task_id'] .'">'. $result['name'] .'</option>';
	}
?>
<script type="text/javascript" src="jquery-1.11.2.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$("#quiz_select").submit(function(event){
		event.preventDefault();
		$.post('retrieve_quiz.php', $("#quiz_select").serialize(), function(data){
			
		})
	})	
})
	
</script>

<form id="quiz_select">
	<p><select id="quiz_name">
		<?php echo $quiz_select; ?>
	</select></p>
	<p><input type="submit" value="Submit"></p>
</form>