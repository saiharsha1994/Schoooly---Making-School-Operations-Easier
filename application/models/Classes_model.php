<?php
class Classes_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function getClassList()
	{
		$this -> db -> select('class_id,name');	 
		$this -> db -> from(TABLE_CLASS);	
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getSectionList()
	{
		$this -> db -> select('section_id,name,class_id,teacher_id');	 
		$this -> db -> from(TABLE_SECTION);	
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