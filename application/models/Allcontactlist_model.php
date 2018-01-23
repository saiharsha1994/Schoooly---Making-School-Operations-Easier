<?php
class AllContactList_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function getTeachersList()
	{
		$q = $this->db->query('SELECT emp_id AS teacher_id,name FROM employee_details');
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getParentsList()
	{
		$q = $this->db->query('SELECT parent_id,name FROM '.TABLE_PARENTS);
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	

}
?>