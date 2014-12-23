<?php
	require('../connect.php');
	if(isset($_POST)){
		$total = sizeof($_POST)-1;
		$right = 0;
		$id = '1';//$_POST['quizID'];answers
		$answers = getAnswers($id);//'{ "q0":"cheese", "q1":"cheese", "q2":"true" }';//
		$answers = json_decode($answers, true);
		foreach (array_slice($_POST, 1) as $key => $value) {
			if($value === $answers[$key]){
				$right++;
			}
		}
		$final = ($right/$total) * 100;
		$final = round($final);
		echo "You got $right questions right. Your final grade is $final";
	}


	function getAnswers($quiz_id){
		global $db;
		$query = "SELECT * FROM subTask WHERE task_id = '$quiz_id';";
		$prep = $db->prepare($query);
		$prep->execute();
		$results = $prep->fetchAll(PDO::FETCH_ASSOC);
		foreach ($results as $result){
			$answer = $result['content'];
		}
		return $answer;
	}
?>

