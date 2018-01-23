<?php
class ArrivalDeparture_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->library('ApiCrypter');
	}
	
	
	function addArrivalDepartureDetails($details){
		$this->db->where('bus_id',$details['bus_id']);
		$this->db->where('driver_id',$details['driver_id']);
		$this->db->where('date',$details['date']);
		$q = $this->db->get('arrival_departure_report');
		if ($q->num_rows() > 0) 
		{
			$this->db->where('bus_id',$details['bus_id']);
			$this->db->where('driver_id',$details['driver_id']);
			$this->db->where('date',$details['date']);
			$this->db->update('arrival_departure_report',$details);
			return $this->db->get('arrival_departure_report')->row()->id;
		} else {
			$this->db->insert("arrival_departure_report", $details);
			$_id = $this->db->insert_id();
			return $_id;
		}		
	}
	
	
	function getArrivalDepartureDetails($bus_id,$from_date,$to_date)
	{
		$this -> db -> select('*');	 
		$this -> db -> from('arrival_departure_report');
		$this -> db -> where('bus_id',$bus_id);
		$this -> db -> where('date>=',$from_date);
		$this -> db -> where('date<=',$to_date);
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
}
?>