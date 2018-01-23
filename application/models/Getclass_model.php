<?php
class GetClass_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function getClassID($Parent_Name,$Child_Name)
	{	
		$this -> db -> select('Class_Id');	 
		$this -> db -> from(TABLE_STUDENTS);	
		$this -> db -> where('Stu_Name', urldecode($Child_Name));
		$this -> db -> where('Parent_Name',urldecode($Parent_Name));		
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