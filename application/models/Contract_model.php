<?php
class Contract_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	
	function getContractList()
	{
		$this -> db -> select('*');	 
		$this -> db -> from('contracts');
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	function addContractDetails($details){
		$this->db->insert("contracts", $details);
		$bus_id = $this->db->insert_id();	
		return $bus_id;		
	}
	
	function editContractDetails($details,$id){
		$this->db->where('id',$id);
		$this->db->update('contracts',$details);
		return true;		
	}
	
	function deleteContractDetails($id){
		$this->db->where('id', $id);
		$this->db->delete('contracts'); 
		return true;		
	}
}
?>