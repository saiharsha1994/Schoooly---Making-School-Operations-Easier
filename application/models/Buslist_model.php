<?php
class Buslist_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	function getbusList()
	{
		$this -> db -> select('*');	 
		$this -> db -> from('bus_details');
		//$this-> db -> where('route_id', 0);
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getSpareBusList()
	{
		$this -> db -> select('*');	 
		$this -> db -> from('bus_details');
		$this-> db -> where('pickup_route_id', 0);
		$this-> db -> where('drop_route_id', 0);
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function reassignBusToSpareBus($from_bus,$to_bus)
	{
		//get pickup and drop id of current bus
		$pickup_route_id =$this->db->get_where('bus_details', array('bus_Id' => $from_bus),null)->row()->pickup_route_id;
		$drop_route_id  =$this->db->get_where('bus_details', array('bus_Id' => $from_bus),null)->row()->drop_route_id;
		
		//get current bus driver_id
		$driver_id  =$this->db->get_where('employee_details', array('assigned_bus' => $from_bus,'pickup_route_id' =>$pickup_route_id,'drop_route_id' =>$drop_route_id),null)->row()->emp_id;
		
		
		//update pickup and drop_route_id in to bus
		$bus_data = array(
			'pickup_route_id' => $pickup_route_id,
			'drop_route_id' => $drop_route_id);
			
		$this->db->where('bus_Id',$to_bus);
		$this->db->update('bus_details',$bus_data);
		
		//update assigned_bus, pickup_route_id and drop_route_id in driver_details
		$driver_data = array(
			'pickup_route_id' => $pickup_route_id,
			'drop_route_id' => $drop_route_id,
			'assigned_bus' => $to_bus);
			
		$this->db->where('emp_id',$driver_id);
		$this->db->update('employee_details',$driver_data);
		
		// update driver and bus in routes
		$route_data = array(
			//'driver_id' => $driver_id,
			'bus_id' => $to_bus);
			
		$this->db->where('bus_id',$from_bus);
		$this->db->update('routes',$route_data);
		
		//update assigned_bus in student
		$this->db->where('assigned_bus',$from_bus);
		$this->db->update('student',$driver_data);
		
		//update assigned_bus in teacher
		$this->db->where('assigned_bus',$from_bus);
		$this->db->update('teacher',$driver_data);
		
		//update attendance data to new bus
		
		
		$this->db->where('bus_id',$from_bus);
		$this->db->where('att_date',date("Y-m-d"));
		
		$this->db->update('attendance_driver',$route_data);
		
		return true;
	}
	
	function getBusDistance($bus_id,$from_date,$to_date)
	{
// SELECT s.route_name,s.trip_type,s.start_time,s.end_time,s.driver_id,s.bus_id, COUNT(r.stop_name) FROM routes s 
		//INNER JOIN route_stops r ON s.route_id=r.route_id WHERE r.route_id=2		
		$sql = "SELECT bc.bus_id,bd.name,bd.plate_number,bc.date FROM bus_coordinates bc 
			INNER JOIN bus_details bd ON bc.bus_id=bd.bus_Id 
			WHERE bc.date >='".$from_date."' AND bc.date<='".$to_date."' AND bc.bus_id=".$bus_id." GROUP BY bc.date";		
		$query1 = $this->db->query($sql);
/* 		$this->db->select('*'); 
		$this-> db -> from('bus_coordinates');
		$this-> db ->where('date >=', $from_date);
		$this-> db ->where('date <=', $to_date);
		$this-> db ->where('bus_id', $bus_id);
		$this->db->group_by('date'); 
		$query1 = $this -> db -> get(); */
		if($query1->num_rows() > 0) {
			foreach (($query1->result_array()) as $row1) {
				$this->db->select_sum('distance');
				$this-> db -> from('bus_coordinates');
				$this-> db ->where('date', $row1['date']);
				$row1['bus_distance'] = $this -> db -> get()->row()->distance;
				$data[] = $row1;
			}
			return $data;
		}
		else{
			return null;
		}
	}
	
	/* function getBusDistance()
	{
		
		$this -> db -> select('*');	 
		$this -> db -> from('bus_details');
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$this->db->select_sum('route_distance');
				$this->db->from('routes');
				$this-> db -> where('bus_id', $row['bus_Id']);
				$query1 = $this -> db -> get();
				if($query1->num_rows() > 0) {
					foreach (($query1->result_array()) as $row1) {
						$row['bus_distance']=$row1['route_distance'];
					}
				}
				//$row['bus_distance']=$query1;
				$data[] = $row;
			}
			return $data;
		}
	} */
	
	function addBusDetails($details){
		$this->db->insert("bus_details", $details);
		$bus_id = $this->db->insert_id();	
		return $bus_id;		
	}
	
	function editBusDetails($details,$bus_id){
		$this->db->where('bus_id',$bus_id);
		$this->db->update('bus_details',$details);
		return true;		
	}
	
	function deleteBusDetails($id){
		$this->db->where('bus_id', $id);
		$this->db->delete('bus_details'); 
		return true;		
	}
	/* function getDatesFromRange($start, $end) {
		$format = 'Y-m-d';
    $array = array();
    $interval = new DateInterval('P1D');

    $realEnd = new DateTime($end);
    $realEnd->add($interval);

    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

    foreach($period as $date) { 
        $array[] = $date->format($format); 
    }

    return $array;
	} */

	
}
?>