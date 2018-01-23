<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ClassRoutine_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function getClassRoutine($Class_Id,$Section_Id)
	{
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$yearQuery = $this->db->get();
		$year= $yearQuery->row('description');
		
		$this -> db -> select('*');	 
		$this -> db -> from(TABLE_CLASS_ROUTINE);		   	 
		$this -> db -> where('class_id', urldecode($Class_Id));
		$this -> db -> where('section_id', urldecode($Section_Id));
		$this -> db -> where('year', $year);
		
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				
				//getSubjectName
				$this -> db -> select('name,teacher_id');	 
				$this -> db -> from(TABLE_SUBJECTS);		   	 
				$this -> db -> where('subject_id', $row['subject_id']);
				$query2 = $this -> db -> get();
				if($query2->num_rows() > 0) {
					$row['subject_id']=$query2->row('name');
					//getTeacherName
					$this -> db -> select('name');	 
					$this -> db -> from('employee_details');		   	 
					$this -> db -> where('emp_id', $query2->row('teacher_id'));
					$query1 = $this -> db -> get();
					if($query1->num_rows() > 0) {
						$row['teacher_id']=$query1->row('name');
					}
				}
				$data[] = $row;	
			}
			return $data;
		}
	}
	
	
	function getTeacherClassRoutine($Teacher_Id)
	{
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$yearQuery = $this->db->get();
		$year= $yearQuery->row('description');
		
		$sql = "SELECT C.class_routine_id,C.class_id,C.section_id,C.time_start,C.time_start_min,C.time_end,C.time_end_min,C.day,C.year,S.teacher_id,S.name FROM ".TABLE_CLASS_ROUTINE." C INNER JOIN ".TABLE_SUBJECTS." S ON
		C.subject_id=S.subject_id WHERE S.teacher_id=".$Teacher_Id;		
		$query = $this->db->query($sql);
		
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$row['class_name']= $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name;
				$row['section_name']= $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name;
				$data[] = $row;
			}
			return $data;
		}
		
	}
	

}
?>