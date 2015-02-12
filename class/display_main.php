<?php


class ListCourses {

	private $db;
	private $user_id;


	public function __construct($data, $user_id){

		$this->db = $data;
		$this->user_id = $user_id;
	}

	public function showCourses() {

	}

}



?>