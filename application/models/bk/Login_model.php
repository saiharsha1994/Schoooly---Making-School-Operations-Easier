<?php
class Login_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->library('ApiCrypter');
	}
	
	function getParentAuthendication($Parent_Email,$Pass_Word,$GCM_RegId)
	{
		$this -> db -> select('Parent_Id, Parent_Name, Parent_Mobile,Stu_Name,Stu_Id');
		$this -> db -> from(TABLE_PARENTS);
		$this -> db -> where('Parent_Email', $Parent_Email);
		$this -> db -> where('Pass_Word', $this->apicrypter->encrypt($Pass_Word));
		$query = $this -> db -> get();
		$Name=$query->row('Parent_Name');
		$User_Id=$query->row('Parent_Id');
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			$insertUpdateQuery="INSERT INTO ".TABLE_GCM." (GCM_RegId, Name, Email,User_Id, User_Type) VALUES ('".$GCM_RegId."', '".$Name."', '".$Parent_Email."','".$User_Id."', 'Parent') ".
					"ON DUPLICATE KEY UPDATE GCM_RegId='".$GCM_RegId."'";
			if($this->db->query($insertUpdateQuery)){
				return $data;	
			}	
		}
	}
	
	function getTeacherAuthendication($Email,$Pass_Word,$GCM_RegId)
	{
		$this -> db -> select('Teacher_Id, Teacher_Name, Class_Id');
		$this -> db -> from(TABLE_TEACHERS);
		$this -> db -> where('Email', $Email);
		$this -> db -> where('Pass_Word', $this->apicrypter->encrypt($Pass_Word));
		$query = $this -> db -> get();
		$Name=$query->row('Teacher_Name');
		$User_Id=$query->row('Teacher_Id');
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			$insertUpdateQuery="INSERT INTO ".TABLE_GCM." (GCM_RegId, Name, Email,User_Id, User_Type) VALUES ('".$GCM_RegId."', '".$Name."', '".$Email."', '".$User_Id."','Admin') ".
					"ON DUPLICATE KEY UPDATE GCM_RegId='".$GCM_RegId."'";
			if($this->db->query($insertUpdateQuery)){
				return $data;	
			}
		}
	}
}
?>