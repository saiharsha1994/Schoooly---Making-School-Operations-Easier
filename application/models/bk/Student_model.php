<?php
class Student_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	/*function getStudentList($Stu_Reg_Id)
	{
		$q = $this->db->query('SELECT Stu_Id,Stu_Name,Stu_Reg_Id,Stu_Image,Parent_Name,Address,Contact_Mail,Contact_Number FROM '.TABLE_STUDENTS.' WHERE Stu_Reg_Id='.$Stu_Reg_Id);
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}*/
	
	function getStudentList($Class_Id)
	{
		$q = $this->db->query('SELECT Stu_Id,Stu_Name,Stu_Reg_Id,Stu_Image,Parent_Name,Address,Contact_Mail,Contact_Number FROM '.TABLE_STUDENTS.' WHERE Class_Id='.$Class_Id);
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
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
	function getStudentsDet()
	{
	   $this -> db -> select('Stu_Id, Stu_Name, Stu_Reg_Id, Stu_Image, Class_Id, Parent_Name, Address, Contact_Mail, Contact_Number');
	   $this -> db -> from(TABLE_STUDENTS);		   	 
	   $query = $this -> db -> get();
	 
		   if($query->num_rows() > 0) {
				foreach (($query->result_array()) as $row) {					
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
	function getStudentDetById($id)
	{
		$this -> db -> select('Stu_Id, Stu_Name, Stu_Reg_Id, Class_Id, Parent_Name, Address, Contact_Mail, Contact_Number');
	    $this -> db -> from(TABLE_STUDENTS);
	    $this -> db -> where('Stu_Id', $id);	   
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
	function addStudentDet($Stu_Name,$Stu_Reg_Id,$Class_Id,$Parent_Name,$Address,$Contact_Mail,$Contact_Number)
	{
		$data=array('Stu_Name'=>$Stu_Name,'Contact_Mail'=>$Contact_Mail,'Stu_Reg_Id'=>$Stu_Reg_Id,'Class_Id'=>$Class_Id,'Parent_Name'=>$Parent_Name,'Address'=>$Address,'Contact_Number'=>$Contact_Number);
		$this->db->insert(TABLE_STUDENTS, $data);
		$query = $this->db->insert_id();
		// print_r($query);
		// exit;
		return (isset($query)) ? 'Info Inserted Successfully' : FALSE;
		
	}
	function UpdateStudentDetById($Stu_Id,$Stu_Name,$Stu_Reg_Id,$Class_Id,$Parent_Name,$Address,$Contact_Mail,$Contact_Number)
	{
		$data=array('Stu_Name'=>$Stu_Name,'Contact_Mail'=>$Contact_Mail,'Stu_Reg_Id'=>$Stu_Reg_Id,'Class_Id'=>$Class_Id,'Parent_Name'=>$Parent_Name,'Address'=>$Address,'Contact_Number'=>$Contact_Number);
		$this->db->where('Stu_Id',$Stu_Id);
		$query = $this->db->update(TABLE_STUDENTS,$data);		
		if($query == 1){			
			return 'Updated Successfully';
		}else{
			return false;
		}		
	}
	function deleteStudentDetById($id)
	{
		$this->db->where('Stu_Id', $id);
		$query = $this->db->delete(TABLE_STUDENTS);		
		// print_r($query);
		if($query == 1){
			return 'Deleted Successfully';
		}else{
			return false;
		}
	}	
	function deleteMultiStudentsDet($ids)
	{
		$ids_exp = explode(',',$ids);
        $this->db->where_in('Stu_Id',$ids_exp);		
		$query = $this->db->delete(TABLE_STUDENTS);		
		// print_r($query);
		if($query == 1){
			return 'Deleted Successfully';
		}else{
			return false;
		}
	}	
}
?>