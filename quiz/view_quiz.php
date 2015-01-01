<?php

require('../connect.php');
	$quiz_select = '<form id="quiz_select">Please select a quiz. <select name="quiz_name" id="quiz_name">';
	$query = "SELECT * FROM task WHERE type = 'q';";
	$prep = $db->prepare($query);
	$prep->execute();
	$results = $prep->fetchAll(PDO::FETCH_ASSOC);
	foreach($results as $result){
		$quiz_select .= '<option value="'. $result['task_id'] .'">'. $result['name'] .'</option>';
	}
	$quiz_select .= '</select><br/><input type="submit" value="Submit"></form>';
	echo $quiz_select;

?>



<script>
	$(document).ready(function(){
		var quiz ='';
		$("#quiz_select").submit(function(event){
			event.preventDefault();
			//$.post('retrive_quiz.php', $("#quiz_select").serialize, function(data){
				console.log(data);
			});
		})
	}
</script>