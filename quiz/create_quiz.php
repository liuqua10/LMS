<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
<script type="text/javascript">
//array to store quiz information
var quiz = [];
var quizAnswers = [];
//counter for sotring question count
var questCount = 1;
var alphabet = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];

function injectQuizNum(){
	$("#quest_tree").append('<option onclick="showQuestion('+ questCount+')" selected="selected">'+questCount+'</option>');
	quiz[questCount]= '';
	quizAnswers[questCount]='';
}

function showQuestion(number){
	var quizElement = quiz[number];
	$('#multiForm, #tfForm').trigger("reset");
	console.log(number);
	console.log(quiz);
	if(quizElement.category == 'mc'){
		$("#multiple_choice, #true_false_questions, #match").hide();
		$("#main").html('Question: '+ quizElement.question + '<br/>');
		for (var i=0; i<quizElement.answer.length; i++){
			$("#main").append('Answer '+alphabet[i]+': '+ quizElement.answer[i]+ '<br/>');
		}
		$("#main").append('Correct Answer: ' + quizAnswers[number]);
		$("#main").append('<br/> <button type="button" onclick="editQuestion('+number+');">Edit</button>');
	} else if (quizElement.category == 'tf'){
		$("#multiple_choice, #true_false_questions, #match").hide();
		$("#main").html('Question: '+ quizElement.question + '<br/>');
		$("#main").append('Answer: ' +quizAnswers[number]);
		$("#main").append('<br/> <button type="button" onclick="editQuestion('+number+');">Edit</button>');
	} else if (quizElement.category == 'ma') {
		$("#multiple_choice, #true_false_questions, #match").hide();
		$("#main").html('Questions: ');
		for (var i =0; i < quizElement.question.length; i++){
			$("#main").append(quizElement.question[i]+ ', ');
		}
		$("#main").append('<br/> Answer: ');
		for (var j =0; j < quizElement.answer.length; j++){
			$("#main").append(quizElement.answer[j]+ ', ') ;
		}
		$("#main").append('<br/> <button type="button" onclick="editQuestion('+number+');">Edit</button>');
	} else {
		$("#main").html('NO INFORMATION ENTERED!');
	}
}

function editQuestion(number){
	$("#main").html("Please Change the Information Below");
	var quizElement= quiz[number];
	$('#multiForm, #tfForm, #matchForm').trigger("reset");
	if (quizElement.category == 'mc'){
		clearMc();
		$("#multiText").val(quizElement.question);
		if (quizElement.answer.length > 4){
			for (var j = 5; j <= quizElement.answer.length; j++){
				$("#multiAnswers").append('<li><p>Answer '+alphabet[j-1]+': <input type="text" name="multi'+j+'" id="multi'+j+'"></p></li>')
			}	
		}
		for (var i = 0; i <= quizElement.answer.length; i++){
			$("#multi"+(i+1)).val(quizElement.answer[i]);
		}
		$("#multiAns").val(quizAnswers[number]);
		$("#multiple_choice").show();
	} else if (quizElement.category == 'tf') {
		$("#tfQuest").val(quizElement.question);
		$("#tfAns").val(quizAnswers[number]);
		$("#true_false_questions").show();
	} else {
		clearMa();
		if (quizElement.answer.length > 4){
			for (var j = 5; j <= quizElement.answer.length; j++){
				$("#matchAnswers").append('<li><p><input type="text" name="match'+j+'" id="match'+j+'"> : <input type="text" name="matchAns'+j+'" id="matchAns'+j+'"</p></li>')
			}	
		}
		for (var i = 0; i < quizElement.question.length; i++){
			var iCount = i+1
			$("#match" + (i+1)).val(quizElement.question[i]);
			$("#matchAns" + (i+1)).val(quizElement.answer[i]);
		}
		$("#match").show();
	}
}

function clearMc(){
	var countDown = parseInt($("#multiCount").val());
	while (countDown > 4){
		$("#multiAnswers li:last").remove();
		countDown--;
	}
	$("#multiCount").val('4');
}

function clearMa(){
	var countDown = parseInt($("#matchCount").val());
	while(countDown > 4){
		$("#matchAnswers li:last").remove();
		countDown--;
	}
	$('#matchCount').val('4');
}

$(document).ready(function(){
	$("#question_nav, #quest_track, #multiple_choice, #true_false_questions, #match").hide();
	//inserts name into the main array as an object, unhides question types
	$("#start_quiz").click(function(){
		var title = {qName: $("#quizName").val()};
		quiz.push(title);
		quizAnswers.push(title);
		injectQuizNum(questCount, quiz, quizAnswers);
		$("#question_nav").show();
		$("#quest_track").show();
		$("#main").html("Please Select a Question Type");
	});

	$("#multi_choice").click(function(){
		$('#multiForm').trigger("reset");
		clearMc();
		$("#main").html("Please Enter Question Information");
		$("#multiple_choice").show();
		$("#true_false_questions, #match").hide();
	});

	$("#true_false").click(function(){
		$('#tfForm').trigger("reset");
		$("#main").html("Please Enter Question Information");
		$("#true_false_questions").show();
		$("#multiple_choice, #match").hide();
	});

	$("#matching").click(function(){
		$('#matching').trigger("reset");
		clearMa();
		$("#main").html("Please Enter Question Information");
		$("#match").show();
		$("#multiple_choice, #true_false_questions").hide();
	});
	$("#multiForm").submit(function(event){
		event.preventDefault();
		var questionNumber = parseInt($("#quest_tree").val());
		var quest = $("#multiText").val();
		var answers = [];
		var count = $("#multiCount").val();
		for (var i = 1; i <= count; i++) {
			if ($("#multi"+i).val() != ""){
				answers.push($("#multi"+i).val());
			}
		}
		var last = {category: 'mc', question: quest, answer: answers};
		quiz[questionNumber] = last;
		var correct = $("#multiAns").val();
		quizAnswers[questionNumber] = correct;
	})

	$("#tfForm").submit(function(event){
		event.preventDefault();
		var quest = $('#tfQuest').val();
		var answerTF = $('#tfAns').val();
		var questionNumber = $("#quest_tree").val();
		var last = {category: 'tf', question:quest, answer: ['true', 'false']};
		quiz[questionNumber]= last;
		quizAnswers[questionNumber] = answerTF;
	})

	$("#matchForm").submit(function(event){
		event.preventDefault();
		var count = $("#matchCount").val();
		var quest = [];
		for (var i = 1; i <= count; i++) {
			if ($("#match"+i).val() != ""){
				quest.push($("#match"+i).val());
			}
		}
		var answers = []
		for (var i = 1; i <= count; i++) {
			if ($("#matchAns"+i).val() != ""){
				answers.push($("#matchAns"+i).val());
			}
		}
		var questionNumber = $("#quest_tree").val();
		var last = {category: 'ma', question:quest, answer: answers};
		quiz[questionNumber]= last;
		quizAnswers[questionNumber] = answers;
	})

	$("#add_question").click(function(){
		questCount++;
		injectQuizNum(questCount, quiz, quizAnswers);
		console.log(quiz);
	})

	$("#add_choices").click(function(){
		var multi = parseInt($("#multiCount").val());
		multi++;
		$("#multiForm ul").append('<li><p>Answer ' + alphabet[multi-1] +': <input type="text" name="multi'+ multi+'" id="multi'+multi+'"></p></li>');
		$('#multiCount').val(multi);
	})

	$("#add_match").click(function(){
		var matc = parseInt($("#matchCount").val());
		matc++;
		$("#matchForm ul").append('<li><p><input type="text" name ="match'+matc+'" id="match'+matc+'" > : <input type="text" name="matchAns'+matc+'" id="matchAns'+matc+'"></p></li>');
		$('#matchCount').val(matc);
	})

});

</script>

<div id="question_nav">
	<button type="button" id="multi_choice">Multiple Choice</button>
	<button type="button" id="true_false">True/False</button>
	<button type="button" id="matching">Matching</button>	
</div>
<div id="quest_track">
	<select id="quest_tree" size="7">
	</select>
	<button type="button" id="add_question">Add Question</button>
</div>
<div id="main">
	Please Enter Quiz Name:<input id="quizName" type="text">
	<button type="button" id="start_quiz">Start Quiz</button>
</div>

<div id="multiple_choice">
	<form id="multiForm">
		<p>Question Text <textarea rows="4" cols="25" name="multiText" id="multiText"></textarea></p>
		<ul id="multiAnswers">
			<li><p>Answer A: <input type="text" name="multi1" id="multi1"></p></li>
			<li><p>Answer B: <input type="text" name="multi2" id="multi2"></p></li> 
			<li><p>Answer C: <input type="text" name="multi3" id="multi3"></p></li> 
			<li><p>Answer D: <input type="text" name="multi4" id="multi4"></p></li>
		</ul>
		<input name="multiCount" id="multiCount" type="hidden" value="4">
		<p>Correction Answer: <input type="text" id="multiAns"></p>
		<button type="button" id="add_choices">Add Another Choice</button><input type="submit" value="Save"></form>	
</div>
<div id="true_false_questions">
	<form id="tfForm"> 
		<p>Question Text <textarea rows="4" cols="25" name="tfQuest" id="tfQuest"></textarea></p>
		<p>Answer: <select id="tfAns">
			<option value="true">True</option>
			<option value="false">False</option>
		</select></p>
		<p><input type="submit" value="Save"></p>
	</form>
</div>
<div id="match">
	<form id="matchForm">
		<p>Question : Answer</p>
		<ul id="matchAnswers">
			<li><p><input type="text" name="match1" id="match1"> : <input type="text" name="matchAns1" id="matchAns1"></p></li>
			<li><p><input type="text" name="match2" id="match2"> : <input type="text" name="matchAns2" id="matchAns2"></p></li>
			<li><p><input type="text" name="match3" id="match3"> : <input type="text" name="matchAns3" id="matchAns3"></p></li>
			<li><p><input type="text" name="match4" id="match4"> : <input type="text" name="matchAns4" id="matchAns4"></p></li>
		</ul>
		<input name="multiCount" id="matchCount" type="hidden" value="4">
		<button type="button" id="add_match">Add another match</button>
		<p><input type="submit" value="Save"></p>
	</form>
</div>
