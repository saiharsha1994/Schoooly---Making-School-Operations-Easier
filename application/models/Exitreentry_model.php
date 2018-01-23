<?php
class Exitreentry_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	
	function getEntriesList($user_type,$user_id)
	{
		$this -> db -> select('*');	 
		$this -> db -> from('exit_re_entries');
		$this -> db -> where('emp_id',$user_id);
		$this -> db -> where('emp_type',$user_type);
		
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	function addExitEntryDetails($details){
		$this->db->insert("exit_re_entries", $details);
		$bus_id = $this->db->insert_id();	
		return $bus_id;		
	}
	
	function editExitEntryDetails($details,$id){
		$this->db->where('id',$id);
		$this->db->update('exit_re_entries',$details);
		return true;		
	}
	
	
}
?>