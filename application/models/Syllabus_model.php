<?php
class Syllabus_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function getSyllabus($class_id)
	{
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$year= $query->row('description');
		
		$this -> db -> select('*');	 
		$this -> db -> from(TABLE_ACADEMIC_SYLLABUS);
		$this -> db -> where('class_id', urldecode($class_id));	
		$this -> db -> where('year', $year);	
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getStudyMaterial($class_id)
	{
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$year= $query->row('description');
		
		$this -> db -> select('*');	 
		$this -> db -> from('document');
		$this -> db -> where('class_id', urldecode($class_id));	
		$this -> db -> where('year', $year);	
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
	
				$this -> db -> from('subject');
				$this -> db -> where('subject_id', $row['subject_id']);
				$row['subject_name']= $this->db->get()->row('name');
				
				$data[] = $row;
			}
			return $data;
		}
	}
	
	
	function getCompleted_academic($class_id,$section_id,$subject_id)
	{
		
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$Year= $query->row('description');

		
		$this -> db -> select('*');	 
		$this -> db -> from('teacher_academics');
		$this -> db -> where('class_id', urldecode($class_id));	
		$this -> db -> where('section_id', urldecode($section_id));	
		$this -> db -> where('subject_id', urldecode($subject_id));	
		$this -> db -> where('complete_status', 2);	
		$this -> db -> where('year', $Year);	
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getTeacher_academic($day,$class_id,$section_id,$subject_id)
	{
		
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$Year= $query->row('description');

		
		$this -> db -> select('*');	 
		$this -> db -> from('teacher_academics');
		$this -> db -> where('class_id', urldecode($class_id));	
		$this -> db -> where('section_id', urldecode($section_id));	
		$this -> db -> where('subject_id', urldecode($subject_id));	
		$this -> db -> where('day', urldecode($day));	
		$this -> db -> where('complete_status', 1);	
		$this -> db -> where('year', $Year);	
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getCompletedTeachPlan($from_date,$to_date,$class_id,$section_id,$subject_id)
	{
		
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$Year= $query->row('description');

		$this -> db -> select('*');	 
		$this -> db -> from('teacher_academics');
		$this -> db -> where('class_id', urldecode($class_id));	
		$this -> db -> where('section_id', urldecode($section_id));	
		$this -> db -> where('subject_id', urldecode($subject_id));	
		$this -> db -> where('completed_on >=', urldecode($from_date));	
		$this -> db -> where('completed_on <=', urldecode($to_date));	
		$this -> db -> where('complete_status', 2);	
		$this -> db -> where('year', $Year);	
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}

	function updateTeacher_academic($sno,$teacher_id,$completed_on,$from_page,$to_page)
	{
		$Arr=array('complete_by'=>$teacher_id,
				'complete_status'=>'2',
				'completed_start_page'=>$from_page,
				'completed_end_page'=>$to_page,
				'completed_on'=>$completed_on);
		$this->db->where('sno',$sno);
		// $query = ;		
		if($this->db->update('teacher_academics',$Arr)){
			return true;
		}else{
			return false;
		}
		//return (isset($query)) ? 'Info Inserted Successfully' : FALSE;
		
	}
}
?>