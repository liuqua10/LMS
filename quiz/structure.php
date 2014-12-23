<?php
	require('../connect.php');
	$query = "SELECT * FROM task WHERE type = 'q';";
	$prep = $db->prepare($query);
	$prep->execute();
	$results = $prep->fetchAll(PDO::FETCH_ASSOC);
	foreach ($results as $result){
		$quiz_id = $result['task_id'];
		$quiz_name = $result['name'];
		$quiz_data = $result['detail'];
	}
?>

<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
<script>

var quiz = <?php echo $quiz_data;?>;

var quizCount = [];
var counter = 0;
var current = 0;

/*var quiz = [
	{
		question: "What is the meaning of life?",
		answers: ["fun", "suffer", "cheese"],
		correct: "cheese"
	},{
		question: "What is most important?",
		answers: ["eat, pray, love", "work, sleep, study", "cheese"],
		correct: "cheese"
	},{
		question: "Seattle is Rainy?",
		answers: ["true", "false"],
		correct: "true"
	}
];*/


function inject (loc, val){
	document.getElementById(loc).innerHTML = val;
}

function displayQuiz(quiz, quizCount){
	var fin = "<form id='quiz'>";
	var alpha = "abcdefghijklmnopqrstuvwxyz".split("");
	fin += '<input type="hidden" name="quizID" value="1">';
	for (var i=0; i<quiz.length; i++){
		quizCount.push("q"+i);
		fin += "<div id='q"+i+"' style='display:none'><p>"+quiz[i].question+"</p><ul>";
		for (var j=0; j<quiz[i].answers.length; j++){
			fin+= "<li><input type='radio' name='q"+ i +"' value='"+quiz[i].answers[j]+"'>"+alpha[j]+'. '+quiz[i].answers[j]+"</li>";
		}
		fin += '<li><input type="radio" name="q'+ i +'" value="unanswered" checked="checked" class="unanswered" style="display:none;"></li>';
		fin += "</ul></div>";
	}
	fin += '</form><button id="grade">Submit</button>';
	inject('stuff', fin)
}

function adjustCounter(counter, quizCount){
	current = (counter+1) + '/ ' + (quizCount.length);
	inject('quest_count', current)
}

$(document).ready(function() {
	displayQuiz(quiz, quizCount);
	current = (counter+1) + '/ ' + (quizCount.length);
	adjustCounter(counter, quizCount);
	$("#q0").show();
	$('#grade').click(function() {
		var answerTrigger = false;
		if ($("input[value='unanswered']").is(':checked')){
			answerTrigger = true;
		}
		if (answerTrigger == true){
			inject("quest_count", "Please answer all questions!");
		} else {
			$.post("grade_quiz.php", $("#quiz").serialize(), function(data){
				alert(data);
			});
		}
	});
	$("#next").click(function(){
		if(counter != quizCount.length-1){
			$("#"+quizCount[counter]).hide();
			counter++;
			$("#"+quizCount[counter]).show();
			adjustCounter(counter, quizCount);
		} else {
			$("#"+quizCount[counter]).hide();
			counter = 0;
			$("#"+quizCount[counter]).show();
			adjustCounter(counter, quizCount);
		}
	})
	$("#prev").click(function(){
		if (counter != 0){
			$("#"+quizCount[counter]).hide();
			counter--;
			$("#"+quizCount[counter]).show();
			adjustCounter(counter, quizCount);
		} else {
			$("#"+quizCount[counter]).hide();
			counter = quizCount.length-1;
			$("#"+quizCount[counter]).show();
			adjustCounter(counter, quizCount);
		}
	})
});
	
</script>

<div id="quest_count"></div>
<div id="stuff">
</div>
<button id="prev" type="button">Previous</button><button id="next" type="button">Next</button>