<?php
class Homework_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function getHomework($Class_Id,$Section_Id)
	{
		$this -> db -> select('*');	 
		$this -> db -> from(TABLE_HOMEWORK);
		$this -> db -> where('class_id', urldecode($Class_Id));	
		$this -> db -> where('section_id', urldecode($Section_Id));			
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getAssignment($Class_Id,$Section_Id)
	{
		$this -> db -> select('*');	 
		$this -> db -> from(TABLE_ASSIGNMENT_TEACHER);
		$this -> db -> where('class_id', urldecode($Class_Id));	
		$this -> db -> where('section_id', urldecode($Section_Id));	
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getHomeworkForTeacher($Teacher_Id)
	{
		$this -> db -> select('*');	 
		$this -> db -> from(TABLE_HOMEWORK);
		$this -> db -> where('teacher_id', urldecode($Teacher_Id));		
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
}
?>