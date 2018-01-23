<?php
class Getroutedetails_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->library('ApiCrypter');
	}
	
	function getRouteForDriverId($driver_id,$trip_type)
	{
		/*
		$this -> db -> select('stop_name,stope_time,latitude,langitude,numeric_order');
		$this -> db -> from('route_stops');
		$this -> db -> where('route_id', $driver_id);
		$this -> db -> where('route_id', $driver_id);
		$query1 = $this -> db -> get();
		if($query1->num_rows() > 0) {
			foreach (($query1->result_array()) as $row1) {
				$data1[] = $row1;
			}
		}
		return $data1;
		*/
		$query=$this->db->query("SELECT stop_name,stope_time,latitude,langitude,numeric_order FROM route_stops WHERE route_id 
			IN (SELECT route_id FROM routes WHERE driver_id='".$driver_id."' AND trip_type='".$trip_type."')");
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$data[] = $row;	
			}
			return $data;
		}
	}	
		
	function getRouteForTransportAdmin($route_id)
	{
		
		$this -> db -> select('stop_name,stope_time,latitude,langitude,numeric_order');
		$this -> db -> from('route_stops');
		$this -> db -> where('route_id', $route_id);
		$query1 = $this -> db -> get();
		if($query1->num_rows() > 0) {
			foreach (($query1->result_array()) as $row1) {
				$data1[] = $row1;
			}
		}
		return $data1;
		
	}
	
	function addRouteDetails($details){
		$this->db->insert("routes", $details);
		return 'Success';		
	}
	
	function addRouteStopDetails($details){
		$this->db->insert("route_stops", $details);
		return 'Success';		
	}
}
?>