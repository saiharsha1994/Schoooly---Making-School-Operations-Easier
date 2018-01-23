<?php
class Dailyupdate_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function getUpdates($Class_Id,$Section_Id)
	{
		
		$this -> db -> select('*');	 
		$this -> db -> from(TABLE_UPDATES);
		$this -> db -> where('class_id', urldecode($Class_Id));	
		$this -> db -> where('section_id', urldecode($Section_Id));	
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function InsertUpdates($Class_Id,$Section_Id,$Todays_Update,$Date)
	{
		$dataArr = array(
			'class_id' => $Class_Id,
			'section_id' => $Section_Id,
			'Todays_Update' => urldecode($Todays_Update),
			'Date' => urldecode($Date));

		if($this->db->insert(TABLE_UPDATES, $dataArr))
		{
			return 'Success';
		}else{
			return 0;
		}		
	}
	
	function deleteUpdate($Update_Id)
	{
		$this->db->delete(TABLE_UPDATES, array('Update_Id' => $Update_Id));
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		return FALSE;
	}
}
?>