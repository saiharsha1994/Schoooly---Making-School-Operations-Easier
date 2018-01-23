<?php
class Marksheet_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	
	function getSemesterList()
	{
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query1 = $this->db->get();
		$Year= $query1->row('description');
		
		$this -> db -> select('ac_id');
		$this -> db -> from('academic_year');
		$this -> db -> where('academic_year', $Year);
		$query2 = $this->db->get();
		$ac_id= $query2->row('ac_id');
		
		$this -> db -> select('*');	 
		$this -> db -> from('semester');
		$this -> db -> where('academic_year_id',$ac_id);
		$query = $this -> db -> get();
		
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getExamsList()
	{
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query1 = $this->db->get();
		$Year= $query1->row('description');
		
		$this -> db -> select('*');	 
		$this -> db -> from('exam_schedule');
		$this -> db -> where('year',$Year);
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getChildMarksReport($exam_id,$child_id)
	{
		$query=$this->db->query("SELECT M.mark_id,M.student_id,M.subject_id,M.class_id,M.section_id,M.exam_id,M.mark_obtained,M.mark_total,C.comment FROM mark M 
			INNER JOIN mark_sheet_comments C ON M.student_id=C.student_id AND M.exam_id=C.exam_id 
			WHERE M.student_id=".$child_id." AND M.exam_id=".$exam_id." AND M.status=2");
				
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$row['subject_name']=$this->db->get_where('subject', array('subject_id' => $row['subject_id']))->row()->name;				
				$row['exam_name']=$this->db->get_where('exam_schedule', array('_id' => $row['exam_id']))->row()->title;				
				$data[] = $row;					
			}				
			return $data;
		}else{
			return false;
		}
	}
	
	function getGradesList()
	{
		$this -> db -> select('*');	 
		$this -> db -> from('grade');
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function addSubjectMarksDetails($details){
		extract($details);
		
		$student_id_arr = explode(',', $student_id);
		$mark_obtained_arr = explode(',', $mark_obtained);
		
		
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$Year= $query->row('description');
		
		for ($i = 0; $i < count($student_id_arr); $i++){
			
			$WhereArr=array(
			'student_id' => $student_id_arr[$i],
			'subject_id' => $subject_id,
			'year' => $Year,
			'exam_id' => $exam_id);
			
			$qu = $this->db->get_where('mark', $WhereArr);
			$count = $qu->num_rows(); //counting result from query
			if ($count == 0) {
				$dataArr = array(
				'student_id' => $student_id_arr[$i],
				'subject_id' => $subject_id,
				'class_id' => $class_id,
				'section_id' => $section_id,
				'exam_id' => $exam_id,
				'mark_obtained' => $mark_obtained_arr[$i],
				'year' => $Year);
				
				$this->db->insert('mark', $dataArr);
			}else{
				$dataArr = array(
				'student_id' => $student_id_arr[$i],
				'subject_id' => $subject_id,
				'class_id' => $class_id,
				'section_id' => $section_id,
				'exam_id' => $exam_id,
				'mark_obtained' => $mark_obtained_arr[$i],
				'year' => $Year);
				
				$this->db->where($WhereArr);
				$this->db->update('mark',$dataArr);
			}
		}
		return true;		
	}
	
	function addClassMarksDetails($details){
		extract($details);
		
		$subject_id_arr = explode(',', $subject_id);
		$mark_obtained_arr = explode(',', $mark_obtained);
		
		
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$Year= $query->row('description');
		
		for ($i = 0; $i < count($subject_id_arr); $i++){
			
			$WhereArr=array(
			'student_id' => $student_id,
			'subject_id' => $subject_id_arr[$i],
			'year' => $Year,
			'exam_id' => $exam_id);
			
			$qu = $this->db->get_where('mark', $WhereArr);
			$count = $qu->num_rows(); //counting result from query
			if ($count == 0) {
				$dataArr = array(
				'student_id' => $student_id,
				'subject_id' => $subject_id_arr[$i],
				'class_id' => $class_id,
				'section_id' => $section_id,
				'exam_id' => $exam_id,
				'mark_obtained' => $mark_obtained_arr[$i],
				'status' => 2,
				'year' => $Year);
				
				$this->db->insert('mark', $dataArr);
			}else{
				$dataArr = array(
				'student_id' => $student_id,
				'subject_id' => $subject_id_arr[$i],
				'class_id' => $class_id,
				'section_id' => $section_id,
				'exam_id' => $exam_id,
				'mark_obtained' => $mark_obtained_arr[$i],
				'status' => 2,
				'year' => $Year);
				
				$this->db->where($WhereArr);
				$this->db->update('mark',$dataArr);
			}
		}
		
		$CommentWhereArr=array(
			'student_id' => $student_id,
			'year' => $Year,
			'exam_id' => $exam_id);
			
		$query = $this->db->get_where('mark_sheet_comments', $CommentWhereArr);
		$queryCount = $query->num_rows(); //counting result from query
			
		$commentArr = array(
			'student_id' => $student_id,
			'exam_id' => $exam_id,
			'comment' => $comment,
			'year' => $Year);
		if ($queryCount == 0) {
			$this->db->insert('mark_sheet_comments', $commentArr);
		}else{
			$this->db->where($CommentWhereArr);
			$this->db->update('mark_sheet_comments',$commentArr);
		}
		
		return true;		
	}
	
}
?>