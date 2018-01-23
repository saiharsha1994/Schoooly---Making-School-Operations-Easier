<?php
class CheckGCM_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function checkUserAvailInGCM($User_Id,$User_Type)
	{	
		$q = $this->db->query("SELECT G_ID FROM ".TABLE_GCM." WHERE User_Id=".$User_Id." AND User_Type='".$User_Type."'");
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
}
?>