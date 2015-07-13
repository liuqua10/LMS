<head>
    <script type="text/javascript" src="jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="display_quiz.js"></script>
</head>
<body>
    <?php
    $id_quiz = $_GET['id_quiz'];
    echo "<input id='id_quiz' type='hidden' value=$id_quiz>";
    ?>
    <div id="quiz_area">
        <form id="quiz">
            <div id="quest_count"></div>
            <div id="stuff">
            </div>
            <button id="prev" type="button">Previous</button><button id="next" type="button">Next</button>
            <input type="submit" value="Grade">
        </form>
    </div>
</body>
