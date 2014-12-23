

<script type="text/javascript" src="jquery-1.11.2.min.js"></script>
<script>


var quizCount = [];
var counter = 0;
var current = 0;

var quiz = [
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
];

var storedAnswer = "hello";

function storeAnswer(){
	storedAnswer = this.value;
}

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
		fin += '<li><input type="radio" name="q'+ i +'" value="unanswered" checked="checked" class="unanswered" style="display:none;"></li>';
		for (var j=0; j<quiz[i].answers.length; j++){
			fin+= "<li><input type='radio' name='q"+ i +"'onclick='storeAnswer();' value='"+quiz[i].answers[j]+"'>"+alpha[j]+'. '+quiz[i].answers[j]+"</li>";
		}
		fin += "</ul></div>";
	}
	fin += '</form><button id="grade">Submit</button>';
	inject('stuff', fin)
}

$(document).ready(function() {
	displayQuiz(quiz, quizCount);
	$("#q0").show();
	$('#grade').click(function() {
		$.post("grade_quiz.php", $("#quiz").serialize(), function(data){
			alert(data);
		});
	});
	$("#next").click(function(){
		if(counter != quizCount.length-1){
			$("#"+quizCount[counter]).hide();
			counter++;
			$("#"+quizCount[counter]).show();
			current = (counter+1) + '/ ' + (quizCount.length);
			inject('quest_count', current)
		} else {
			$("#"+quizCount[counter]).hide();
			counter = 0;
			$("#"+quizCount[counter]).show();
			current = (counter+1) + '/ ' + (quizCount.length);
			inject('quest_count', current)
		}
	})
	$("#prev").click(function(){
		if (counter != 0){
			$("#"+quizCount[counter]).hide();
			counter--;
			$("#"+quizCount[counter]).show();
			current = (counter+1) + '/ ' + (quizCount.length);
			inject('quest_count', current)
		} else {
			$("#"+quizCount[counter]).hide();
			counter = quizCount.length-1;
			$("#"+quizCount[counter]).show();
			current = (counter+1) + '/ ' + (quizCount.length);
			inject('quest_count', current)
		}
	})
});
	
</script>

<div id="quest_count">1/3</div>
<div id="stuff">
</div>
<button id="prev" type="button">Previous</button><button id="next" type="button">Next</button>
