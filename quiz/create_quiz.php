<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
<script type="text/javascript">
//array to store quiz information
var quiz = [];
var quizAnswers = {};
//counter for sotring question count
var questCount = 1;
//multiple choice html
/*var qMulti = '<form id="multiForm"> Question Text <textarea rows="4" cols="25" name="multiA" id="multiText"></textarea> <br/> Answer: <input type="text" name="multiB" id="multiA"> <br/> Answer: <input type="text" name="multiB" id="multiB"> <br/> Answer: <input type="text" name="multiC" id="multiC"> <br/> Answer: <input type="text" name="multiD" id="multiD"> <br/> Correction Answer: <input type="text" id="multiAns"><br/><input type="submit" value="Add"></form>';
//true/false html
var trueFalse = '<form id="tfForm"> Question Text <textarea rows="4" cols="25" name="tfQuest" id="tfQuest"></textarea><br/>Answer: <select id="tfAns"><option value="True">True</option><option value="False">False</option></select></br><input type="submit" value="Add"></form>';
*/
function injectQuizNum(count){
	$("#quest_tree").append('<option onclick="showQuestion('+ count +')" selected="selected">'+count+'</option>');
}

$(document).ready(function(){
	$("#question_nav").hide();
	$("#quest_track").hide();
	$("#multiple_choice").hide();
	$("#true_false_questions").hide();
	//inserts name into the main array as an object, unhides question types
	$("#start_quiz").click(function(){
		var title = {qName: $("#quizName").val()};
		quiz.push(title);
		injectQuizNum(questCount);
		$("#question_nav").show();
		$("#quest_track").show();
		$("#main").html("Please Select a Question Type");
	});
	$("#multi_choice").click(function(){
		$("#multiple_choice").show();
		$("#true_false_questions").hide();
	});
	$("#true_false").click(function(){
		$("#true_false_questions").show();
		$("#multiple_choice").hide();
	});
	$("#multiForm").submit(function(event){
		event.preventDefault();
		var quest = $("#multiText").val();
		var answers = [];
		var count = $("#multiCount").val();
		for (var i = 1; i <= count; i++) {
			if ($("#multi"+i).val() != ""){
				answers.push($("#multi"+i).val());
			}
		}
		var last = {type: 'mc', question: quest, answer: answers};
		quiz.push(last);
		var questionNumber = "q"+ $("quest_tree").val();
		var correct = $("#multiAns").val();
		quizAnswers[questionNumber] = correct;
		console.log(quiz[1]);
		console.log(quizAnswers);

	})

	$("#tfForm").submit(function(event){
		event.preventDefault();
		var quest = $('#tfQuest').val();
		var answerTF = $('#tfAns').val();
		var questionNumber = "q"+ $("quest_tree").val();
		var last = {type: 'tf', question:quest, answer: ['true', 'false']};
		quiz.push(last);
		quizAnswers[questionNumber] = answerTF;
		console.log(quiz[1]);
		console.log(quizAnswers);
	})

	$("#add_question").click(function(){
		questCount++;
		injectQuizNum(questCount);
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
		<p>Answer A: <input type="text" name="multi1" id="multi1"></p>
		<p>Answer B: <input type="text" name="multi2" id="multi2"></p> 
		<p>Answer C: <input type="text" name="multi3" id="multi3"></p> 
		<p>Answer D: <input type="text" name="multi4" id="multi4"></p>
		<input name="multiCount" id="multiCount" type="hidden" value="4">
		<p>Correction Answer: <input type="text" id="multiAns"></p>
		<input type="submit" value="Save"></form>	
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
