<?php

require('../connect.php');

if (isset($_POST)){
    $task_id = $_POST['id_quiz'];
    $query = "SELECT detail FROM task WHERE task_id = '$task_id';";
    $prep = $db->prepare($query);
    $prep->execute();
    $results = $prep->fetch(PDO::FETCH_ASSOC);
    echo $results["detail"];
}

?>
