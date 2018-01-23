<?php
class Event_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function getEvents()
	{
		$this -> db -> select('*');	 
		$this -> db -> from(TABLE_EVENT);	
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getVacationsAndBreaks()
	{
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query1 = $this->db->get();
		$year= $query1->row('description');
		
		$this -> db -> select('*');	 
		$this -> db -> from('vacation_additional_break');
		$this -> db -> where('year',$year);
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getExamDates()
	{
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query1 = $this->db->get();
		$year= $query1->row('description');
		
		$this -> db -> select('*');	 
		$this -> db -> from('exam_schedule');
		$this -> db -> where('year',$year);
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getEventDetById($Event_Id)
	{
		$this -> db -> select('*');	 
		$this -> db -> from(TABLE_EVENT);	
		$this -> db -> where('Event_Id', urldecode($Event_Id));			
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function InsertData($Event_Title,$Event_Info,$Event_Date)
	{
		$Event_AddedOn = date("Y-m-d H:i:s");
		$dataArr = array(
			'Event_Title' => urldecode($Event_Title),
			'Event_Info' => $Event_Info,
			'Event_Date' => $Event_Date,
			'Event_AddedOn' => $Event_AddedOn);

		if($this->db->insert(TABLE_EVENT, $dataArr)){
			return 'Success';
		}		
	}
	
	function UpdateDataById($Event_Id,$Event_Title,$Event_Info,$Event_Date)
	{
		$Event_AddedOn = date("Y-m-d H:i:s");
		$dataArr = array(
			'Event_Title' => urldecode($Event_Title),
			'Event_Info' => $Event_Info,
			'Event_Date' => $Event_Date,
			'Event_AddedOn' => $Event_AddedOn);
		$this->db->where('Subject_Id',$Subject_Id);
		$this->db->insert(TABLE_EVENT, $dataArr);
		if($query == 1){			
			return 'Updated Successfully';
		}else{
			return false;
		}
		return (isset($query)) ? 'Info Inserted Successfully' : FALSE;
	}
	
	function deleteEvent($id)
	{
		$this->db->where('Event_Id', $id);
		$query = $this->db->delete(TABLE_EVENT);		
		// print_r($query);
		if($query == 1){
			return 'Deleted Successfully';
		}else{
			return false;
		}
	}
	
	function deleteMultiEventsDet($ids)
	{
		$ids_exp = explode(',',$ids);
        $this->db->where_in('Event_Id',$ids_exp);		
		$query = $this->db->delete(TABLE_EVENT);		
		// print_r($query);
		if($query == 1){
			return 'Deleted Successfully';
		}else{
			return false;
		}
	}
}
?>