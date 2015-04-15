<?php

require("../database.php");

class Course {

	protected $db;
	public $courseID;

	public function __construct($course_id, $data){
		$this->db = $data;
		$this->CourseID = $course_id;
	}

	public function display_quiz() {
		$this->db->query("SELECT * FROM task WHERE type = 'q';");
		$results = $this->db->resultset();
		foreach($results as $result){
			$res = '<a href="../quiz/view.php?=id_quiz='.$result['task_id'].'">'.$result['name'].'</a>';
			$res .= '<br/>';
			echo $res;
		}
	}

	public function display_forum () {
		$this->db->query("SELECT * FROM task WHERE type = 'm';");
		$results = $this->db->resultset();
		foreach($results as $result) {
			$res = '<a href="../forum/view.php?id_forum='.$result['task_id'].'">'.$result['name'].'</a>';
			$res .= '<br/>';
			var_dump($res);
		}	
	}

	public function show() {
		echo "<h3>Quizzes</h3>";
		$this->display_quiz();
		echo "<h3>Forums</h3>";
		$this->display_forum();
	}
} 

$db = new Database();

$course = new Course($_GET['id_course'], $db);
$course->show();
?>