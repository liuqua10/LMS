<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
<script type="text/javascript">
//array to store quiz information
var quiz = [];
//counter for sotring question count
var questCount = 0;
//multiple choice html
var qMulti = '<form id="multiForm"> Question Text <textarea rows="4" cols="25" name="multiA" id="multiText"></textarea> <br/> Answer: <input type="text" name="multiB" id="multiA"> <br/> Answer: <input type="text" name="multiB" id="multiB"> <br/> Answer: <input type="text" name="multiC" id="multiC"> <br/> Answer: <input type="text" name="multiD" id="multiD"> <br/> Correction Answer: <input type="text" id="multiAns"><br/><input type="submit" value="Add"></form>';
//true/false html
var trueFalse = '<form id="tfForm"> Question Text <textarea rows="4" cols="25" name="tfQuest" id="tfQuest"></textarea><br/>Answer: <select id="tfAns"><option value="True">True</option><option value="False">False</option></select></br><input type="submit" value="Add"></form>';

$(document).ready(function(){
	$("#question_nav").hide();
	//inserts name into the main array as an object, unhides question types
	$("#start_quiz").click(function(){
		var title = {qName: $("#quizName").val()};
		quiz.push(title);
		$("#question_nav").show();
		$("#main").html("Please Select a Question Type");
	});
	$("#multi_choice").click(function(){
		$("#main").html(qMulti);
	});
	$("#true_false").click(function(){
		$("#main").html(trueFalse);
	});	
});

</script>

<div id="question_nav">
	<button type="button" id="multi_choice">Multiple Choice</button>
	<button type="button" id="true_false">True/False</button>
	<button type="button" id="matching">Matching</button>
</div>
<div id="main">
	Please Enter Quiz Name:<input id="quizName" type="text">
	<button type="button" id="start_quiz">Start Quiz</button>
</div>
