<?php
class Driverlist_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	function getdriverList()
	{
		/* $this -> db -> select('*');	 
		$this -> db -> from('employee_details');
		//$this-> db -> where('route_id', 0);
		$query = $this -> db -> get();
		
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$data[] = $row;		
			}
		}
		 */
		$driver_role_id=$this->db->get_where('hr_roles', array('role' => 'driver'))->row()->id;
		
		$this -> db -> select('emp_id AS driver_id,name,mobile, photo,assigned_bus,pickup_route_id,drop_route_id,emp_type');	
		$employees   =   $this->db->get('employee_details')->result_array();
		if(count($employees)>0){
			foreach($employees as $row){
				$exists=0;
				$role_arr = explode(',', $row['emp_type']);
				foreach ($role_arr as $role) {
					if($role!=''&&$role==$driver_role_id){
						$exists=1;
					}
				}  
				if($exists==1){
					$data[] = $row;
				}
			}
			return $data;
		}else{
			return false;
		}
	}
	function getDriverMerits($month){
		$sql = "SELECT dm.id,dm.driver_id,dd.name,dd.photo,dd.assigned_bus,dd.mobile,dm.speed_limit,dm.rash_driving,dm.time_maitanance FROM employee_details dd 
				INNER JOIN driver_merit_system dm 
				ON dd.emp_id=dm.driver_id WHERE dm.review_month='".$month."'";		
		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getDriverDetailsByStud($stu_id){
		$Stu_Ids_List = explode('|',urldecode($stu_id));
		$Stu_Ids_Arr = $this ->toInArray($Stu_Ids_List);
		
		$sql = "SELECT b.plate_number,d.emp_id AS driver_id,d.name,d.mobile,d.photo FROM bus_details b 
				INNER JOIN employee_details d ON b.bus_id=d.assigned_bus 
				INNER JOIN student s ON d.assigned_bus=s.assigned_bus WHERE s.student_id IN (".$Stu_Ids_Arr.")";		
		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function addDriverMerits($details){
		$this->db->insert("driver_merit_system", $details);
		$merit_id = $this->db->insert_id();	
		return $merit_id;	
	}
	
	
	function addDriverDetails($details){
		$this->db->insert("employee_details", $details);
		$driver_id = $this->db->insert_id();	
		return $driver_id;		
	}
	
	function editDriverDetails($details,$driver_id){
		$this->db->where('emp_id',$driver_id);
		$this->db->update('employee_details',$details);
		return true;		
	}
	
	function deleteDriverDetails($id){
		$this->db->where('emp_id', $id);
		$this->db->delete('employee_details'); 
		return true;		
	}
	
	function toInArray($cus_ids){
		$res_id_arr ='';
		foreach($cus_ids as $cus_id){
			$res_id_arr .= "'".$cus_id."',";
		}
		$res_id_arr = rtrim($res_id_arr,",");
		return $res_id_arr;
	}
}
?>