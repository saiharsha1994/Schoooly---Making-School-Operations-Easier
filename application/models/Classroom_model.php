<?php
class Classroom_model extends CI_Model {
	function __construct()
	{
		parent::__construct();		
	}
	
	function getClassDet()
	{
	   $this -> db -> select('Class_Id, Class_Name');
	   $this -> db -> from(TABLE_CLASS);		   	 
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
	function getClassDetById($id)
	{
		$this -> db -> select('Class_Id, Class_Name');
	    $this -> db -> from(TABLE_CLASS);
	    $this -> db -> where('Class_Id', $id);	   
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
	function addClassDet($Class_Name)
	{
		$data=array('Class_Name'=>$Class_Name);
		$this->db->insert(TABLE_CLASS, $data);
		$query = $this->db->insert_id();
		// print_r($query);
		// exit;
		return (isset($query)) ? 'Info Inserted Successfully' : FALSE;
		
	}
	function UpdateClassDetById($Class_Id,$Class_Name)
	{
		$data=array('Class_Name'=>$Class_Name);
		$this->db->where('Class_Id',$Class_Id);
		$query = $this->db->update(TABLE_CLASS,$data);		
		if($query == 1){			
			return 'Updated Successfully';
		}else{
			return false;
		}
		return (isset($query)) ? 'Info Inserted Successfully' : FALSE;
		
	}
	function deleteClassDetById($id)
	{
		$this->db->where('Class_Id', $id);
		$query = $this->db->delete(TABLE_CLASS);		
		// print_r($query);
		if($query == 1){
			return 'Deleted Successfully';
		}else{
			return false;
		}
	}	
	function deleteMultiClassDet($ids)
	{
		$ids_exp = explode(',',$ids);
        $this->db->where_in('Class_Id',$ids_exp);		
		$query = $this->db->delete(TABLE_CLASS);		
		// print_r($query);
		if($query == 1){
			return 'Deleted Successfully';
		}else{
			return false;
		}
	}	
}
?>