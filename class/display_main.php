<?php

require("../database.php");

class ListCourses {

    private $db;
    private $user_id;


    public function __construct($data, $user_id){

        $this->db = $data;
        $this->user_id = $user_id;
    }

    public function showCourses() {

        $this->db->query("SELECT * FROM class_enroll WHERE id_user = :id");
        $this->db->bind(":id", $this->user_id);
        $results = $this->db->resultset();
        foreach($results as $result) {
            $this->db->query("SELECT * FROM course WHERE id_course = :id");
            $this->db->bind(":id", $result['id_course']);
            $result = $this->db->single();
            echo '<a href="course_main.php?id_course='. $result['id_course'] .'">'. $result['course_name'] .'</a><br/>';
        }
    }
}

$db = new Database();

$course = new ListCourses($db, '1');

$course->showCourses();

?>
