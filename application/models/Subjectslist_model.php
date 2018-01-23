<?php
class SubjectsList_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function getsubjectList($Class_Id)
	{
		$this -> db -> select('*');	 
		$this -> db -> from(TABLE_SUBJECTS);	
		$this -> db -> where('Class_Id', urldecode($Class_Id));			
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getSubjectDet()
	{
	   $this -> db -> select('*');
	   $this -> db -> from(TABLE_SUBJECTS);		   	 
	   $query = $this -> db -> get();
	 
		   if($query->num_rows() > 0) {
				foreach (($query->result_array()) as $row) {					
					$data[] = $row;						
				}				
			return $data;
		   }else{
				return false;
		   }
	}	
	
	function getSubjectDetById($id)
	{
		$this -> db -> select('*');
	    $this -> db -> from(TABLE_SUBJECTS);
	    $this -> db -> where('Subject_Id', $id);	   
	    $this -> db -> limit(1);		
		$query = $this->db->get();
		if($query->num_rows() > 0){
			foreach (($query->result_array()) as $row) {				
				$data[] = $row;					
			}
			return $data;
		}else{
			return false;
		}
	}
	
	function addSubjectDet($DataArr)
	{
		$this->db->insert(TABLE_SUBJECTS, $DataArr);
		$query = $this->db->insert_id();
		// print_r($query);
		// exit;
		return (isset($query)) ? 'Info Inserted Successfully' : FALSE;
		
	}
	
	function UpdateSubjectDetById($Subject_Id,$DataArr)
	{
		$this->db->where('Subject_Id',$Subject_Id);
		$query = $this->db->update(TABLE_SUBJECTS,$DataArr);		
		if($query == 1){			
			return 'Updated Successfully';
		}else{
			return false;
		}
		return (isset($query)) ? 'Info Inserted Successfully' : FALSE;
		
	}
	
	function deleteSubjectDetById($id)
	{
		$this->db->where('Subject_Id', $id);
		$query = $this->db->delete(TABLE_SUBJECTS);		
		// print_r($query);
		if($query == 1){
			return 'Deleted Successfully';
		}else{
			return false;
		}
	}
	
	function deleteMultiSubjectDet($ids)
	{
		$ids_exp = explode(',',$ids);
        $this->db->where_in('Subject_Id',$ids_exp);		
		$query = $this->db->delete(TABLE_SUBJECTS);		
		// print_r($query);
		if($query == 1){
			return 'Deleted Successfully';
		}else{
			return false;
		}
	}
}
?>