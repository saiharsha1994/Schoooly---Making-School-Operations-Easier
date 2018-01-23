<?php
class Parent_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	
	function getParentList()
	{
		$this -> db -> select('*');	 
		$this -> db -> from('parent');
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
				foreach (($query->result_array()) as $row){ 
					$q=$this->db->get_where('student', array('parent_id' => $row['parent_id']))->result_array();
					$child="";
					foreach ($q as $row1){
						$child=$child.$row1['name']."|";
					}
					if($child){
						$row['children']=substr($child, 0, -1);
					}else{
						$row['children']="";
					}
					$data[] = $row;
				}
			
			return $data;
		}
	}
			
	function addDetails($details){
		$this->db->insert("parent", $details);
		$bus_id = $this->db->insert_id();	
		return $bus_id;		
	}
	
	function editDetails($details,$id){
		$this->db->where('parent_id',$id);
		$this->db->update('parent',$details);
		return true;		
	}
	
	function deleteParentDetails($id){
		$this->db->where('parent_id', $id);
		$this->db->delete('parent'); 
		return true;		
	}
		
}
?>