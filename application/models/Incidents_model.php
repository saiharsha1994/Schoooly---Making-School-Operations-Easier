 <?php
class Incidents_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}
	
	
	function getIncidentList($from_date,$to_date,$bus_id)
	{
		$this -> db -> select('*');	 
		$this -> db -> from('incidents');
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
	
	function getHealthRequestListByUsertype($user_id,$user_type)
	{
		$running_year       =	$this->db->get_where('settings' , array('type'=>'running_year'))->row()->description;
		
		$this -> db -> select('*');	 
		$this -> db -> from('health_request');
		$this -> db -> where('user_type',$user_type);
		$this -> db -> where('request_by',$user_id);
		$this -> db -> where('year',$running_year);
		
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getIncidentListById($id)
	{
		$this -> db -> select('*');	 
		$this -> db -> from('incidents');
		$this -> db -> where('incident_id',$id);
		
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
		
	function addDetails($details){
		$this->db->insert("incidents", $details);
		$bus_id = $this->db->insert_id();	
		return $bus_id;		
	}
	
	function editDetails($details,$id){
		$this->db->where('incident_id',$id);
		$this->db->update('incidents',$details);
		return true;		
	}
	
	function deleteDetails($id){
		$this->db->where('incident_id', $id);
		$this->db->delete('incidents'); 
		return true;		
	}
	
	function addHealthRequest($details){
		if($this->db->insert("health_request", $details)){
			return true;
		}else{
			return false;		
		}
	}
		
}
?>