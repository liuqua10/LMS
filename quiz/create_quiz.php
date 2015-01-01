<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
<script type="text/javascript">
// array to store quiz information
var quiz = [];
// store the answers to the quiz
var quizAnswers = [];
// counter for total question count
var questCount = 1;
// alphabet list for choices
var alphabet = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
// default choice number
var DEFAULT_NUM = 4;
// empty variable to store the quiz name after creation for sending to the php script.
var qName = '';



$(document).ready(function(){
	"use strict";
	// hide question type navigation, question tracking tree, forms of multople choices, true/false, and match
	$("#question_nav, #quest_track, #multiple_choice, #true_false_questions, #match").hide();
	// store the name of the quiz into Quiz and QuizAnswer Array 
	$("#start_quiz").click(function(){
		var title = {qName: $("#quizName").val()};
		quiz.push(title);
		quizAnswers.push(title);
		qName = $("#quizName").val();
		$("#main").html("Please Select a Question Type");
		injectQuizNum(questCount, quiz, quizAnswers);
		// unhide question type navigation and question tracking tree
		$("#question_nav").show();
		$("#quest_track").show();
	});

///////////////////////Save the quiz to the database
	$("#save_quiz").click(function(){
		var quizData = JSON.stringify(quiz);
		var quizAns = JSON.stringify(quizAnswers);
		$.post('store_quiz.php', {quizName: qName, questions: quizData, answers: quizAns}, function(data){
			console.log(data);
		});
	})


/////////////////////////// Could reduce redundency by creating new functions and unifiying the id names for questions/////////////////////// 
	// when Multiple Choice button were clicked, it will reset the form hide other question forms
	$("#multi_choice").click(function(){
		$('#multiForm').trigger("reset");
		clear('multi');
		$("#main").html("Please Enter Question Information");
		$("#multiple_choice").show();
		$("#true_false_questions, #match").hide();
	});
	// when True/False button were clicked, it will reset the form hide other question forms
	$("#true_false").click(function(){
		$('#tfForm').trigger("reset");
		$("#main").html("Please Enter Question Information");
		$("#true_false_questions").show();
		$("#multiple_choice, #match").hide();
	});

	// when Matching button were clicked, it will reset the form hide other question forms
	$("#matching").click(function(){
		$('#matchForm').trigger("reset");
		clear('match');
		$("#main").html("Please Enter Question Information");
		$("#match").show();
		$("#multiple_choice, #true_false_questions").hide();
	});
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	


////////////////////////////Could Simplify using functions//////////////////
	// when the user save the form it will be saved with category, question and answer. The correct answer will be save in quizAnswers
	$("#multiForm").submit(function(event){
		event.preventDefault();
		$('#saving1').show();
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
		$('#saving1').fadeOut(500);
		$('#saved1').delay(600).fadeIn();
		$('#saved1').fadeOut(600);
	})

	$("#tfForm").submit(function(event){
		$('#saving2').show();
		event.preventDefault();
		var quest = $('#tfQuest').val();
		var answerTF = $('#tfAns').val();
		var questionNumber = $("#quest_tree").val();
		var last = {category: 'tf', question:quest, answer: ['true', 'false']};
		quiz[questionNumber]= last;
		quizAnswers[questionNumber] = answerTF;
		$('#saving2').fadeOut(500);
		$('#saved2').delay(600).fadeIn();
		$('#saved2').fadeOut(600);
	})

	$("#matchForm").submit(function(event){
		$('#saving3').show();
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
		$('#saving3').fadeOut(500);
		$('#saved3').delay(600).fadeIn();
		$('#saved3').fadeOut(600);
	})
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	// add new questions when clicked =increment the total number count and put it in the question navigation tree
	$("#add_question").click(function(){
		questCount++;
		injectQuizNum(questCount, quiz, quizAnswers);
		//console.log(quiz);
	})

	// adding new choice when add button is clicked
	$("#add_choices").click(function(){
		var multi = parseInt($("#multiCount").val());
		multi++;
		$("#multiForm ul").append('<li><p>Answer ' + alphabet[multi-1] +': <input type="text" name="multi'+ multi+'" id="multi'+multi+'"></p></li>');
		$('#multiCount').val(multi);
	})

	// adding new matches when add button is clicked
	$("#add_match").click(function(){
		var matc = parseInt($("#matchCount").val());
		matc++;
		$("#matchForm ul").append('<li><p><input type="text" name ="match'+matc+'" id="match'+matc+'" > : <input type="text" name="matchAns'+matc+'" id="matchAns'+matc+'"></p></li>');
		$('#matchCount').val(matc);
	})

});

// create a list of question navigation tree that keeps track when creating questions
function injectQuizNum(){
	$("#quest_tree").append('<option onclick="showQuestion('+ questCount+')" selected="selected">'+questCount+'</option>');
	quiz[questCount]= '';
	quizAnswers[questCount]='';
}

// shows the question everytime when the numbers in the question tree is selected. If the question has already been stored
// it will show in webpage the questions, choices and corret answer, else it will show "No information entered."
function showQuestion(number){
	var quizElement = quiz[number];
	$('#multiForm, #tfForm').trigger("reset");
	// if the question is a multiple choice
	if(quizElement.category == 'mc'){
		$("#multiple_choice, #true_false_questions, #match").hide();
		$("#main").html('Question: '+ quizElement.question + '<br/>');
		for (var i=0; i<quizElement.answer.length; i++){
			$("#main").append('Answer '+alphabet[i]+': '+ quizElement.answer[i]+ '<br/>');
		}
		$("#main").append('Correct Answer: ' + quizAnswers[number]);
		$("#main").append('<br/> <button type="button" onclick="editQuestion('+number+');">Edit</button>');
	// if the question is a ture/false
	} else if (quizElement.category == 'tf'){
		$("#multiple_choice, #true_false_questions, #match").hide();
		$("#main").html('Question: '+ quizElement.question + '<br/>');
		$("#main").append('Answer: ' +quizAnswers[number]);
		$("#main").append('<br/> <button type="button" onclick="editQuestion('+number+');">Edit</button>');
	// if the question is a matching problem
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
	// if it belongs to none of these category, it will remind the user to enter new information
	} else {
		$("#main").html('NO INFORMATION ENTERED!');
	}
}

// Load and edit the stored question when "Edit" is clicked. 
function editQuestion(number){
	$("#main").html("Please Change the Information Below");
	var quizElement= quiz[number];
	$('#multiForm, #tfForm, #matchForm').trigger("reset");
	if (quizElement.category == 'mc'){
		clear('multi');
		$("#multiText").val(quizElement.question);
		if (quizElement.answer.length > DEFAULT_NUM){
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
		clear('match');
		if (quizElement.answer.length > DEFAULT_NUM){
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

// delete the extra option in multiple choice or matches to a default number of 4
function clear(question_type) {
	var countDown = parseInt($('#' + question_type + 'Count').val());
	while (countDown > DEFAULT_NUM){
		$('#' + question_type + 'Answers li:last').remove();
		countDown--;
	}
	$('#' + question_type + 'Count').val(''+DEFAULT_NUM);

}

</script>

<div id="question_nav">
	<h2>Please Select a Question type</h2>
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
		<button type="button" id="add_choices">Add Another Choice</button>
		<input type="submit" value="Save">
		<span class="saving" style="display:none" id="saving1">
			<!-- Change to server! -->
			<img src="loading.gif" alt="icon" /> saving...
		</span>
		<span class="saved" style="display:none" id="saved1">
			saved
		</span>
	</form>	
</div>
<div id="true_false_questions">
	<form id="tfForm"> 
		<p>Question Text <textarea rows="4" cols="25" name="tfQuest" id="tfQuest"></textarea></p>
		<p>Answer: <select id="tfAns">
			<option value="true">True</option>
			<option value="false">False</option>
		</select></p>
		<input type="submit" value="Save">
		<span class="saving" style="display:none" id="saving2">
		<!-- Change to server! -->
			<img src="loading.gif" alt="icon" /> saving...
		</span>
		<span class="saved" style="display:none" id="saved2">
			saved
		</span>
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
		<input type="submit" value="Save">
		<!-- Change to server! -->
		<span class="saving" style="display:none" id="saving3">
			<img src="loading.gif" alt="icon" /> saving...
		</span>
		<span class="saved" style="display:none" id="saved3">
			saved
		</span>
	</form>
</div>
<button type="button" id="save_quiz">Save Quiz</button>
