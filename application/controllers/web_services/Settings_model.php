<?php
class Settings_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	function getSettingList()
	{
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'system_name');
		$query1 = $this->db->get();
		$school_name= $query1->row('description');

		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'system_title');
		$query1 = $this->db->get();
		$system_title= $query1->row('description');
		
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'address');
		$query1 = $this->db->get();
		$address= $query1->row('description');

		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'phone');
		$query1 = $this->db->get();
		$phone= $query1->row('description');

		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'school_location');
		$query1 = $this->db->get();
		$location= $query1->row('description');
		
		
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'speed_limit');
		$query2 = $this->db->get();
		$speed_limit= $query2->row('description');
		
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'school_fence');
		$query3 = $this->db->get();
		$school_fence= $query3->row('description');		
		
		$this -> db -> select('*');		
		$this -> db -> from(TABLE_SETTING);		
		$this -> db -> where('type', 'attendance_percentage');		
		$query3 = $this->db->get();		
		$attendance_percentage= $query3->row('description');
		
		$this -> db -> select('*');		
		$this -> db -> from(TABLE_SETTING);		
		$this -> db -> where('type', 'weekends');		
		$query3 = $this->db->get();		
		$weekends= $query3->row('description');
		
		$this -> db -> select('*');		
		$this -> db -> from(TABLE_SETTING);		
		$this -> db -> where('type', 'chat_time');		
		$query3 = $this->db->get();		
		$chat_time= $query3->row('description');
		
		$row['school_name']=$school_name;
		$row['system_title']=$system_title;
		$row['address']=$address;
		$row['phone']=$phone;
		$row['school_location']=$location;
		$row['speed_limit']=$speed_limit;
		$row['school_fence']=$school_fence;
		$row['attendance_percentage']=$attendance_percentage;
		$row['weekends']=$weekends;
		$row['chat_time']=$chat_time;
		
		$data[] = $row;
		return $data;
	}
	
	function updateSettingsList($data)
	{		
	//$school_name,$system_title,$address,$phone,$location,$speed_limit,$school_fence
		extract($data);
		$this->db->set('description',$school_name)
				->where('type','system_name')
				->update(TABLE_SETTING);
		$this->db->set('description',$system_title)
				->where('type','system_title')
				->update(TABLE_SETTING);
		$this->db->set('description',$address)
				->where('type','address')
				->update(TABLE_SETTING);
		$this->db->set('description',$phone)
				->where('type','phone')
				->update(TABLE_SETTING);
		$this->db->set('description',$location)
				->where('type','school_location')
				->update(TABLE_SETTING);
		$this->db->set('description',$speed_limit)
				->where('type','speed_limit')
				->update(TABLE_SETTING);
		$this->db->set('description',$school_fence)
				->where('type','school_fence')
				->update(TABLE_SETTING);
				
		return true;
	}
	
	
	function getHRRolesList()
	{
		$this -> db -> select('*');	 
		$this -> db -> from('hr_roles');
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$data[] = $row;
			}
			return $data;
		}else{
			return false;
		}
	}
}
?>