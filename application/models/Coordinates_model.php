<?php
class Coordinates_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
		//$this->load->library('apicrypter');
	}
	
	
	function getCurrentCoordinates($Stu_Id,$Date)
	{
		$query=$this->db->query("SELECT latitude,langitude,trip_type,cur_speed FROM bus_coordinates_temp WHERE bus_id IN 
			(SELECT assigned_bus FROM student WHERE student_id='".$Stu_Id."') AND date='".$Date."' 
			ORDER BY id DESC LIMIT 1");
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$data[] = $row;	
			}
			return $data;
		}
	}
	
	function getCoordinatesForSpeed($From_Date,$To_Date)
	{
		$this -> db -> select('*');
		$this -> db -> from('bus_coordinates');
		$this->db->where('date >=', $From_Date);
		$this->db->where('date <=', $To_Date);
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				
				$row['bus_name'] = $this->db->get_where('bus_details', array('bus_id' => $row['bus_id']))->row()->name;
				$row['driver_name'] = $this->db->get_where('employee_details', array('emp_id' => $row['driver_id']))->row()->name;
        
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getCurrentCoordinatesOfAllBuses()
	{
		$query=$this->db->query("SELECT bc.id,bc.date,bc.bus_id,bc.driver_id,bc.latitude,bc.langitude,bc.cur_speed,bc.status,bc.trip_type,bd.plate_number,bd.pickup_route_id,bd.drop_route_id
			FROM bus_coordinates_temp bc INNER JOIN bus_details bd ON bc.bus_id=bd.bus_id GROUP BY bc.bus_id");
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$row['driver_name'] =$this->db->get_where('employee_details', array('emp_id' => $row['driver_id']),null)->row()->name;
				$row['driver_mobile'] =$this->db->get_where('employee_details', array('emp_id' => $row['driver_id']),null)->row()->mobile;
				$row['driver_image'] =$this->db->get_where('employee_details', array('emp_id' => $row['driver_id']),null)->row()->photo;
				
				$row['pickup_route'] =$this->db->get_where('routes', array('route_id' => $row['pickup_route_id']),null)->row()->route_name;	
				$row['drop_route'] =$this->db->get_where('routes', array('route_id' => $row['drop_route_id']),null)->row()->route_name;	
				
				if($row['trip_type']==1){
					$row['no_of_students'] =$this->db->get_where('route_stops', array('route_id' => $row['pickup_route_id']),null)->num_rows();	
				}else{
					$row['no_of_students'] =$this->db->get_where('route_stops', array('route_id' => $row['drop_route_id']),null)->num_rows();	
				}
				
				$row['no_of_present'] =$this->db->get_where('attendance_driver', array('att_date' => $row['date'],'driver_id' => $row['driver_id'],'trip_type' => $row['trip_type'],'in_status' => 1),null)->num_rows();	
				$row['no_of_absent'] =$this->db->get_where('attendance_driver', array('att_date' => $row['date'],'driver_id' => $row['driver_id'],'trip_type' => $row['trip_type'],'in_status' => 2),null)->num_rows();	
				
				
				
				$data[] = $row;	
			}
			return $data;
		}
	}
	
	function InsertData($bus_id, $driver_id, $latitude,$langitude,$cur_speed,$distance,$trip_type)
	{
		$dataArr = array(
			'bus_id' => $bus_id,
			'driver_id' => $driver_id,
			'latitude' => $latitude,
			'langitude' => $langitude,
			'cur_speed' => $cur_speed,
			'distance' => $distance,
			'trip_type' => $trip_type,
			'date' =>date("Y-m-d"));
				
		$this->db->insert("bus_coordinates", $dataArr);
		//return 'Success';		
		
		$this->db->where('bus_id',$bus_id);
		$q = $this->db->get('bus_coordinates_temp');
		if ($q->num_rows() > 0) 
		{
			$this->db->where('bus_id',$bus_id);
			$this->db->update('bus_coordinates_temp',$dataArr);
			return "Success";
		} else {
			$this->db->insert('bus_coordinates_temp',$dataArr);
			return "Success";
		}
	}
	
	function InsertBusDisable($bus_id, $status)
	{
		
		$dataArr = array(
			'bus_id' => $bus_id,
			'status' => $status,
			'last_updated' =>date("Y-m-d"));
				
//		$this->db->insert("bus_disable", $dataArr);
	//	return 'Success';	

		$query = $this->db->update('bus_disable', $dataArr);		
		if($query == 1){			
			return 'Updated Successfully';
		}else{
			return false;
		}		
	}

	function recordBusStatus($bus_id, $status)
	{
		
		$dataArr = array(
			'bus_id' => $bus_id,
			'status' => $status,
			'last_updated' =>date("Y-m-d"));
				
		$this->db->insert("bus_breakdown", $dataArr);
		return 'Success';			
	}
	
	function getBreakdownRecords($bus_id,$From_Date,$To_Date)
	{
		$this->db->select('bus_breakdown.bus_id,bus_breakdown.status,bus_breakdown.last_updated,bus_details.name');
		$this->db->from('bus_breakdown');
		$this->db->where('bus_breakdown.status', '2');
		$this->db->where('bus_breakdown.bus_id', $bus_id);
		$this->db->where('bus_breakdown.last_updated >=', $From_Date);
		$this->db->where('bus_breakdown.last_updated <=', $To_Date);
		$this->db->join('bus_details', 'bus_breakdown.bus_id = bus_details.bus_Id', 'left'); 
		$query = $this->db->get();

		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getBusRouteDisableStatus()
	{
		$this -> db -> select('status,last_updated');
		$this -> db -> from('bus_disable');
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