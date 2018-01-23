<?php
class Welcome_model extends CI_Model {
	function __construct()
	{
		parent::__construct();	
		$this->load->library('ApiCrypter');
	}
	
	function getClassDet()
	{
	   $this -> db -> select('Class_Id, Class_Name');
	   $this -> db -> from(TABLE_CLASS);		   	 
	   $query = $this -> db -> get();
	 
		   if($query->num_rows() > 0) {
				foreach (($query->result_array()) as $row) {					
					$data[$row['Class_Id']] = $row['Class_Name'];					
				}				
			return $data;
		   }else{
				return false;
		   }
	}
	function getTeachersDet()
	{
	   $this -> db -> select('Teacher_Id, Teacher_Name, Class_Id, Email, Pass_Word');
	   $this -> db -> from(TABLE_TEACHERS);		   	 
	   $query = $this -> db -> get();
	 
		   if($query->num_rows() > 0) {
				foreach (($query->result_array()) as $row) {
					$row['Pass_Word'] = $this->apicrypter->decrypt($row['Pass_Word']);
					$data[] = $row;					
				}
				// echo "<pre>";
				// print_r($data);
				// echo "</pre>";
			return $data;
		   }else{
				return false;
		   }
	}
	function getTeacherDetById($id)
	{
		$this -> db -> select('Teacher_Id, Teacher_Name, Class_Id, Email, Pass_Word');
	    $this -> db -> from(TABLE_TEACHERS);
	    $this -> db -> where('Teacher_Id', $id);	   
	    $this -> db -> limit(1);		
		$query = $this->db->get();
		if($query->num_rows() > 0){
			foreach (($query->result_array()) as $row) {
				$row['Pass_Word'] = $this->apicrypter->decrypt($row['Pass_Word']);
				$data[] = $row;					
			}
			return $data;
		}else{
			return false;
		}
	}
	function addTeacherDet($Teacher_Name,$Email,$Class_Id,$Pass_Word)
	{
		$data=array('Teacher_Name'=>$Teacher_Name,'Email'=>$Email,'Class_Id'=>$Class_Id,'Pass_Word'=>$this->apicrypter->encrypt($Pass_Word));
		$this->db->insert(TABLE_TEACHERS, $data);
		$query = $this->db->insert_id();
		// print_r($query);
		// exit;
		return (isset($query)) ? 'Info Inserted Successfully' : FALSE;
		
	}
	function UpdateTeacherDetById($Teacher_Id,$Teacher_Name,$Email,$Class_Id,$Pass_Word)
	{
		$data=array('Teacher_Name'=>$Teacher_Name,'Email'=>$Email,'Class_Id'=>$Class_Id,'Pass_Word'=>$this->apicrypter->encrypt($Pass_Word));
		$this->db->where('Teacher_Id',$Teacher_Id);
		$query = $this->db->update(TABLE_TEACHERS,$data);		
		if($query == 1){			
			return 'Updated Successfully';
		}else{
			return false;
		}		
	}
	function deleteTeacherDetById($id)
	{
		$this->db->where('Teacher_Id', $id);
		$query = $this->db->delete(TABLE_TEACHERS);		
		// print_r($query);
		if($query == 1){
			return 'Deleted Successfully';
		}else{
			return false;
		}
	}	
	function deleteMultiTeachersDet($ids)
	{
		$ids_exp = explode(',',$ids);
        $this->db->where_in('Teacher_Id',$ids_exp);		
		$query = $this->db->delete(TABLE_TEACHERS);		
		// print_r($query);
		if($query == 1){
			return 'Deleted Successfully';
		}else{
			return false;
		}
	}	
}
?>