<?php
class Transport_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function getDetailsByStu_Id($Stu_Id)
	{
		$driver_role= $this->db->get_where('hr_roles', array(strtoupper('role') => 'DRIVER'))->row()->id;
		//$query=$this->db->query("SELECT d.name,d.mobile,d.photo,b.name as route_name,b.chassis_number,b.plate_number,b.fahas,b.bus_from,b.bus_to FROM employee_details d INNER JOIN bus_details b ON d.assigned_bus=b.bus_Id WHERE b.bus_Id IN (SELECT assigned_bus FROM student WHERE student_id=".$Stu_Id.")");
		$query=$this->db->query("SELECT d.name,d.mobile,d.photo,b.name as route_name,b.chassis_number,b.plate_number,b.fahas,b.bus_from,b.bus_to 
			FROM employee_details d INNER JOIN bus_details b 
			ON d.assigned_bus=b.bus_Id 
			WHERE d.emp_type IN (".$driver_role.") AND b.bus_Id IN (SELECT assigned_bus FROM student WHERE student_id=".$Stu_Id.")");
		
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getDetailsByTeacher_id($Id)
	{
		$driver_role= $this->db->get_where('hr_roles', array(strtoupper('role') => 'DRIVER'))->row()->id;
		$query=$this->db->query("SELECT d.name,d.mobile,d.photo,b.name as route_name,b.chassis_number,b.plate_number,b.fahas,b.bus_from,b.bus_to 
			FROM employee_details d INNER JOIN bus_details b 
			ON d.assigned_bus=b.bus_Id WHERE d.emp_type IN (".$driver_role.") AND b.bus_Id IN (SELECT assigned_bus FROM employee_details WHERE emp_id=".$Id.")");
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
}
?>