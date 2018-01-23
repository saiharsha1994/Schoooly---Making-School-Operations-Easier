<?php
class Pettycash_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	
	function getPettyCashList($from_date,$to_date,$driver_id,$amount_for,$pc_id)
	{
		
		$this -> db -> select('*');	 
		$this -> db -> from('petty_cash');
		if($from_date!=null){
			$this -> db -> where('date >=', $from_date);
		}
		if($to_date!=null){
			$this -> db -> where('date <=', $to_date);
		}
		if($driver_id!=0){
			$this -> db -> where('driver_id', $driver_id);
		}
		if($pc_id!=null){
			if($pc_id!=0){
				$this -> db -> where('id', $pc_id);
			}
		}
			
		$this -> db -> where('amount_for', $amount_for);
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$row['driver_name'] = $this->db->get_where('employee_details', array('emp_id' => $row['driver_id']))->row()->name;
				$data[] = $row;
			}
			return $data;
		}
	}
	function getDriverPettyCashList($amount_for,$driver_id)
	{
		$this -> db -> select('*');	 
		$this -> db -> from('petty_cash');
		$this-> db -> where('amount_for', $amount_for);
		$this-> db -> where('driver_id', $driver_id);
		$this-> db -> where('amount_spend', '');
		
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getDriverPettyCashListByDate($driver_id,$from_date,$to_date,$amount_for)
	{
		$this -> db -> select('*');	 
		$this -> db -> from('petty_cash');
		$this-> db -> where('amount_for', $amount_for);
		$this-> db -> where('driver_id', $driver_id);
		$this-> db ->where('date >=', $from_date);
		$this-> db ->where('date <=', $to_date);
		
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
		
	function addDetails($details){
		$this->db->insert("petty_cash", $details);
		$bus_id = $this->db->insert_id();	
		return $bus_id;		
	}
	
	function editBusDetails($details,$pc_id){
		if($pc_id==0){
			$this->db->insert("petty_cash", $details);
		}else{
			$this->db->where('id',$pc_id);
			$this->db->update('petty_cash',$details);
		}
		return true;		
	}
	
	function deletePettyCashDetails($id){
		$this->db->where('id', $id);
		$this->db->delete('petty_cash'); 
		return true;		
	}
		
}
?>