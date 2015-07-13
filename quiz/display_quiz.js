var quizCount = [];
var counter = 0;
var current = 0;

$(document).ready(function(){
/////////// hide the quiz navigation area on load
    $("#quiz_area").hide();
/////////// user selects which quiz to view
    $.post('retrieve_quiz.php', {id_quiz:1} , function(data) {
        console.log(data);
        data = JSON.parse(data);
        console.log(data);
        displayQuiz(data, quizCount);
    });

    $("#quiz").submit(function(event) {
        event.preventDefault();
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
    });

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
    });

});


function displayQuiz(quiz, quizCount){
    var fin = "";
    var alpha = "abcdefghijklmnopqrstuvwxyz".split("");
    fin += '<input type="hidden" name="quizID" value="1">';
    for (var i=1; i<quiz.length; i++){
        if(quiz[i].category != 'ma'){
            quizCount.push("q"+i);
            fin += "<div id='q"+i+"' style='display:none'><p>"+quiz[i].question+"</p><ul>";
            answers = quiz[i].answer;
            for (var j=0; j <= answers.length - 1; j++){
                fin += "<li><input type='radio' name='q"+ i +"' value='"+answers[j]+"'>"+alpha[j]+'. '+answers[j]+"</li>";
            }
        fin += '<li><input type="radio" name="q'+ i +'" value="unanswered" checked="checked" class="unanswered" style="display:none;"></li>';
        } else {
            var matchSelect = '';
            answers = quiz[i].answer.sort();
            quizCount.push("q"+i);
            fin += "<div id='q"+i+"' style='display:none'><ul>";
            for(var j = 0; j < answers.length; j++){
                matchSelect += '<option value="'+answers[j]+'">'+answers[j]+'</option>';
            }
            for(var k = 0; k < quiz[i].question.length; k++){
                fin += '<li>'+ quiz[i].question[k]+' : <select name="q'+i+'-'+k+'" id="q'+i+'-'+k+'" >'+matchSelect+'</select>';
            }
        }
        fin += "</ul></div>";
    }
    $("#stuff").html(fin);
    $("#quiz_area, #stuff").show();
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
