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

var quiz = '';

var quizCount = [];
var counter = 0;
var current = 0;

$(document).ready(function(){
/////////// hide the quiz navigation area on load
	$("#quiz_area").hide();
/////////// user selects which quiz to view	
	$("#quiz_select").submit(function(event){
		event.preventDefault();
		$.post('retrieve_quiz.php', $("#quiz_select").serialize(), function(data){
			quiz = $.parseJSON(data);
			console.log(quiz);
			displayQuiz(quiz, quizCount);
		})
	})

	$('#grade').click(function() {
		var answerTrigger = false;
		if ($("input[value='unanswered']").is(':checked')){
			answerTrigger = true;
		}
		if (answerTrigger == true){
			$("#quest_count").html("Please answer all questions!");
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

})


function displayQuiz(quiz, quizCount){
	var fin = "<form id='quiz'>";
	var alpha = "abcdefghijklmnopqrstuvwxyz".split("");
	fin += '<input type="hidden" name="quizID" value="1">';
	for (var i=1; i<quiz.length; i++){
		if(quiz[i].category != 'ma'){
			quizCount.push("q"+i);
			fin += "<div id='q"+i+"' style='display:none'><p>"+quiz[i].question+"</p><ul>";
			for (var j=0; j<quiz[i].answer.length; j++){
				fin += "<li><input type='radio' name='q"+ i +"' value='"+quiz[i].answer[j]+"'>"+alpha[j]+'. '+quiz[i].answer[j]+"</li>";
			}
		} else {
			var matchSelect = '';
			answers = quiz[i].answer.sort();
			quizCount.push("q"+i);
			fin += "<div id='q"+i+"' style='display:none'><ul>";
			for(var j = 0; j < answers.length; j++){
				matchSelect += '<option value="'+answers[j]+'">'+answers[j]+'</option>';
			}
			for(var k = 0; k < quiz[i].question.length; k++){
				fin += '<li>'+ quiz[i].question[k]+' : <select>'+matchSelect+'</select>';
			}
		}	
		fin += '<li><input type="radio" name="q'+ i +'" value="unanswered" checked="checked" class="unanswered" style="display:none;"></li>';
		fin += "</ul></div>";
	}
	fin += '</form><button id="grade">Submit</button>';
	$("#stuff").html(fin);
	$("#quiz_area").show();
}

function adjustCounter(counter, quizCount){
	current = (counter+1) + '/ ' + (quizCount.length);
	$("#quest_count").html(current);
}

function shuffle(array) {
  var m = array.length, t, i;

  // While there remain elements to shuffle…
  while (m) {

    // Pick a remaining element…
    i = Math.floor(Math.random() * m--);

    // And swap it with the current element.
    t = array[m];
    array[m] = array[i];
    array[i] = t;
  }

  return array;
}

</script>

<form id="quiz_select">
	<p><select name="quiz_name" id="quiz_name">
		<?php echo $quiz_select; ?>
	</select></p>
	<p><input type="submit" value="Submit"></p>
</form>
<div id="quiz_area">
	<div id="quest_count"></div>
	<div id="stuff">
	</div>
	<button id="prev" type="button">Previous</button><button id="next" type="button">Next</button>
</div>