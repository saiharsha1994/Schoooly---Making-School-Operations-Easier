<?php
class Login_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->library('ApiCrypter');
	}
	
	function getParentAuthendication($Parent_Email,$Pass_Word,$GCM_RegId)
	{
		$this -> db -> select('parent_id, name, phone');
		$this -> db -> from(TABLE_PARENTS);
		$this -> db -> where('email', $Parent_Email);
		$this -> db -> where('password', $this->apicrypter->encrypt($Pass_Word));
		$query = $this -> db -> get();
		$Name=$query->row('name');
		$User_Id=$query->row('parent_id');
		if($query->num_rows() > 0) {
			
			$this -> db -> select('*');
			$this -> db -> from(TABLE_SETTING);
			$this -> db -> where('type', 'school_location');
			$query1 = $this->db->get();
			$location= $query1->row('description');
			
			foreach (($query->result_array()) as $row) {
				$row['school_location']=$location;
				$data[] = $row;
			}
			$insertUpdateQuery="INSERT INTO ".TABLE_GCM." (GCM_RegId, Name, Email,User_Id, User_Type) VALUES ('".$GCM_RegId."', '".$Name."', '".$Parent_Email."','".$User_Id."', 'parent') ".
					"ON DUPLICATE KEY UPDATE GCM_RegId='".$GCM_RegId."'";
			if($this->db->query($insertUpdateQuery)){
				return $data;	
			}	
		}
	}
	
	function getTransAdminAuthendication($Email,$Password,$GCM_RegId)
	{
		$role_id=$this->db->get_where('hr_roles', array('role' => 'transport admin'))->row()->id;
		
		$this -> db -> select('emp_id, name, email,emp_type');
		$this -> db -> from('employee_details');
		$this -> db -> where('login', $Email);
		$this -> db -> where('password', $this->apicrypter->encrypt($Password));
		$query = $this -> db -> get();
		
		//print_r($employees);
		if($query->num_rows() > 0){
			foreach($query->result_array() as $row){
				$exists=0;
				$x = explode(',', $row['emp_type']);
				foreach ($x as $r) {
					if($r!=''&&$r==$role_id){
						$exists=1;
					}
				}
				if($exists==1){
					$Name=$row['name'];
					$User_Id=$row['emp_id'];
					$emp_email=$row['email'];
					
					$location=$this->db->get_where(TABLE_SETTING, array('type' => 'school_location'))->row()->description;
					$school_name=$this->db->get_where(TABLE_SETTING, array('type' => 'system_name'))->row()->description;
					$speed_limit=$this->db->get_where(TABLE_SETTING, array('type' => 'speed_limit'))->row()->description;
					$school_fence=$this->db->get_where(TABLE_SETTING, array('type' => 'school_fence'))->row()->description;
					
					foreach (($query->result_array()) as $row) {
						$data['emp_id']=$row['emp_id'];
						$data['name']=$row['name'];
						$data['type_id']=$role_id;
						$data['school_location']=$location;
						$data['speed_limit']=$speed_limit;
						$data['school_name']=$school_name;
						$data['school_fence']=$school_fence;
						
						//$data[] = $row;
					}
					$insertUpdateQuery="INSERT INTO ".TABLE_GCM." (GCM_RegId, Name, Email,User_Id, User_Type) 
							VALUES ('".$GCM_RegId."', '".$Name."', '".$emp_email."','".$User_Id."', 'transport') ".
							"ON DUPLICATE KEY UPDATE GCM_RegId='".$GCM_RegId."', User_Type='transport'";
					$this->db->query($insertUpdateQuery);
					return $data;	
				
				}else{
					return false;
				}
			}
		}else{
			return false;
		}
	}
	
	function getTransAdminPortalAuthendication($Email,$Password)
	{
		$role_id=$this->db->get_where('hr_roles', array('role' => 'transport admin'))->row()->id;
		
		$this -> db -> select('emp_id, name, email, emp_type');
		$this -> db -> from('employee_details');
		$this -> db -> where('login', $Email);
		$this -> db -> where('password', $this->apicrypter->encrypt($Password));
		$query = $this -> db -> get();
		
		//print_r($employees);
		if($query->num_rows() > 0){
			foreach($query->result_array() as $row){
				$exists=0;
				$x = explode(',', $row['emp_type']);
				foreach ($x as $r) {
					if($r!=''&&$r==$role_id){
						$exists=1;
					}
				}
				if($exists==1){
					$Name=$row['name'];
					$User_Id=$row['emp_id'];
					$emp_email=$row['email'];
					
					$location=$this->db->get_where(TABLE_SETTING, array('type' => 'school_location'))->row()->description;
					$school_name=$this->db->get_where(TABLE_SETTING, array('type' => 'system_name'))->row()->description;
					$speed_limit=$this->db->get_where(TABLE_SETTING, array('type' => 'speed_limit'))->row()->description;
					$school_fence=$this->db->get_where(TABLE_SETTING, array('type' => 'school_fence'))->row()->description;
					
					foreach (($query->result_array()) as $row) {
						/* $data['emp_id']=$row['emp_id'];
						$data['name']=$row['name'];
						$data['type_id']=$role_id;
						$data['school_location']=$location;
						$data['speed_limit']=$speed_limit;
						$data['school_name']=$school_name;
						$data['school_fence']=$school_fence;
						 */
						$row['emp_id']=$row['emp_id'];
						$row['name']=$row['name'];
						$row['type_id']=$role_id;
						$row['school_location']=$location;
						$row['speed_limit']=$speed_limit;
						$row['school_name']=$school_name;
						$row['school_fence']=$school_fence;
						$data[] = $row;
					}
					return $data;	
				}else{
					return false;
				}
			}
		}else{
			return false;
		}
	}
	
	function getTeacherAuthendication($Email,$Pass_Word,$GCM_RegId)
	{
		$role_id=$this->db->get_where('hr_roles', array('role' => 'teacher'))->row()->id;
		
		$this -> db -> select('emp_id AS teacher_id, name, email,emp_type AS emp_roles');
		$this -> db -> from('employee_details');
		$this -> db -> where('login', $Email);
		$this -> db -> where('password', $this->apicrypter->encrypt($Pass_Word));
		$query = $this -> db -> get();
		
		//print_r($employees);
		if($query->num_rows() > 0){
			foreach($query->result_array() as $row){
				$exists=0;
				$x = explode(',', $row['emp_roles']);
				foreach ($x as $r) {
					if($r!=''&&$r==$role_id){
						$exists=1;
					}
				}
				if($exists==1){
					$Name=$row['name'];
					$User_Id=$row['teacher_id'];
					$emp_email=$row['email'];
					
					foreach (($query->result_array()) as $row) {
						/* $data['teacher_id']=$row['emp_id'];
						$data['name']=$row['name'];
						$data['type_id']=$role_id;
						 */
						$row['type_id']=$role_id;
						$data[] = $row;
					}
					return $data;	
				}else{
					return false;
				}
			}
		}else{
			return false;
		}
	}

	function getDriverAuthendication($Mobile,$Password)
	{
		
		$role_id=$this->db->get_where('hr_roles', array('role' => 'driver'))->row()->id;
		
		$this -> db -> select('emp_id AS driver_id , name, email,emp_type,assigned_bus,photo,pickup_route_id,drop_route_id');
		$this -> db -> from('employee_details');
		$this -> db -> where('login', $Mobile);
		$this -> db -> where('password', $Password);
		$query = $this -> db -> get();
		
		//print_r($employees);
		if($query->num_rows() > 0){
			foreach($query->result_array() as $row){
				$exists=0;
				$x = explode(',', $row['emp_type']);
				foreach ($x as $r) {
					if($r!=''&&$r==$role_id){
						$exists=1;
					}
				}
				if($exists==1){
					// $Name=$row['name'];
					// $User_Id=$row['emp_id'];
					// $emp_email=$row['email'];
					
					foreach (($query->result_array()) as $row) {
						
						/* $data['driver_id']=$row['driver_id'];
						$data['name']=$row['name'];
						$data['assigned_bus']=$row['assigned_bus'];
						$data['photo']=$row['photo'];
						$data['pickup_route_id']=$row['pickup_route_id'];
						$data['drop_route_id']=$row['drop_route_id']; */
						
						$row['school_location']=$this->db->get_where(TABLE_SETTING, array('type' => 'school_location'))->row()->description;
						$row['speed_limit']=$this->db->get_where(TABLE_SETTING, array('type' => 'speed_limit'))->row()->description;
						
						if($row['pickup_route_id']!=0){
							$row['pickup_start_time']=$this->db->get_where('routes' , array('route_id' => $row['pickup_route_id']))->row()->start_time;
							$row['pickup_end_time']=$this->db->get_where('routes' , array('route_id' => $row['pickup_route_id']))->row()->end_time;	
						}else{
							$row['pickup_start_time']="";
							$row['pickup_end_time']="";	
						}
						if($row['drop_route_id']!=0){
							$row['drop_start_time']=$this->db->get_where('routes' , array('route_id' => $row['drop_route_id']))->row()->start_time;
							$row['drop_end_time']=$this->db->get_where('routes' , array('route_id' => $row['drop_route_id']))->row()->end_time;
						}else{
							$row['drop_start_time']="";
							$row['drop_end_time']="";
						}						
						$row['type_id']=$role_id;
						$data[] = $row;
					}
					return $data;	
				}else{
					return false;
				}
			}
		}else{
			return false;
		}
		
		
		/* $this -> db -> select('driver_id, name,assigned_bus,photo,pickup_route_id,drop_route_id');
		$this -> db -> from('driver_details');
		$this -> db -> where('mobile', $Mobile);
		$this -> db -> where('password', $this->apicrypter->encrypt($Password));
		$query = $this -> db -> get();
		
		echo $query->num_rows();
		if($query->num_rows() > 0) {
			
			$location=$this->db->get_where(TABLE_SETTING, array('type' => 'school_location'))->row()->description;
			$speed_limit=$this->db->get_where(TABLE_SETTING, array('type' => 'speed_limit'))->row()->description;
			
			foreach (($query->result_array()) as $row) {
				
				$data['driver_id']=$location;
				$data['name']=$location;
				$data['assigned_bus']=$location;
				$data['photo']=$location;
				$data['pickup_route_id']=$location;
				$data['drop_route_id']=$location;
				
				$data['school_location']=$location;
				$data['speed_limit']=$speed_limit;
				
				$data['pickup_start_time']=$this->db->get_where('routes' , array('route_id' => $row['pickup_route_id']))->row()->start_time;
				$data['pickup_end_time']=$this->db->get_where('routes' , array('route_id' => $row['pickup_route_id']))->row()->end_time;
				$data['drop_start_time']=$this->db->get_where('routes' , array('route_id' => $row['drop_route_id']))->row()->start_time;
				$data['drop_end_time']=$this->db->get_where('routes' , array('route_id' => $row['drop_route_id']))->row()->end_time;
				//$data[] = $row;
			}
			return $data;
		} */
	}
	
	function getChildNameID($parent_id){
		$this -> db -> select('student_id,name,Latitude,Longitude,pickup_radius,drop_radius');	 
		$this -> db -> from(TABLE_STUDENTS);		   	 
		$this -> db -> where('parent_id', $parent_id);
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				//getClass&Section
				$this -> db -> select('class_id,section_id');	 
				$this -> db -> from(TABLE_ENROLL);		   	 
				$this -> db -> where('student_id', $row['student_id']);
				$query2 = $this -> db -> get();
				if($query2->num_rows() > 0) {
					$row['class_id']=$query2->row('class_id');
					$row['section_id']=$query2->row('section_id');
				}
				$data[] = $row;	
			}
			return $data;
		}
	}
}
?>