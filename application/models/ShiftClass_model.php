<?php
class ShiftClass_model extends CI_Model {
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
					$data[$row['Class_Id']] = $row['Class_Name'];					
				}				
			return $data;
		   }else{
				return false;
		   }
	}

	function getStudentDetByClassId($id)
	{
		$this -> db -> select('Stu_Id, Stu_Name, Stu_Reg_Id');
	    $this -> db -> from(TABLE_STUDENTS);
	    $this -> db -> where('Class_Id', $id);	   	
		$query = $this->db->get();
		if($query->num_rows() > 0){
			foreach (($query->result_array()) as $row) {				
				$data[] = $row;					
			}
			return $data;
		}else{
			return 'empty';
		}
	}
	
	function UpdateStudentClassById($Stu_Ids,$Class_Id)
	{
		$ids_exp = explode(',',$Stu_Ids);
		$data=array('Class_Id'=>$Class_Id);
		$this->db->where_in('Stu_Id',$ids_exp);
		$query = $this->db->update(TABLE_STUDENTS,$data);		
		if($query == 1){			
			return 'Transferred Successfully';
		}else{
			return false;
		}		
	}	
}
?>