<?php
class Notification_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function getNotificationData()
	{
		$this -> db -> select('*');
		$this -> db -> from(TABLE_NOTICE);		   	 
		$query = $this -> db -> get();
		
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}else{
			return false;
		}
		
	}
	
	function getNoticeBoardData($Type)
	{
		$this -> db -> select('*');
		$this -> db -> from(TABLE_NOTICEBOARD);
		$this -> db -> where('reciever', $Type);
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

	function InsertData($Notice_Title,$Notice_Info,$Notice_Date,$Notice_Img)
	{
		$img = str_replace('|', '/', urldecode($Notice_Img));
		$Notice_AddedOn = date("Y-m-d H:i:s");
		$dataArr = array(
			'Notice_Title' => urldecode($Notice_Title),
			'Notice_Info' => urldecode($Notice_Info),
			'Notice_Date' => $Notice_Date,
			'Notice_Img' => $img,
			'Notice_AddedOn' => $Notice_AddedOn);

		if($this->db->insert(TABLE_NOTICE, $dataArr))
		{
			return 'Success';
		}		
	}
	
	function DeleteNoticeData($Notice_Id)
	{
		$this->db->delete(TABLE_NOTICE, array('Notice_Id' => $Notice_Id));
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		return FALSE;
	}
	
	function getAlertList($user_id)
	{
		$this -> db -> select('*');
		$this -> db -> from('notify_alert');		   	 
		$this -> db -> where('user_type','1');
		$this -> db -> where('alert_to',$user_id);
		$this->db->order_by("id", "desc");
        $this->db->limit(5);
		
		$query = $this -> db -> get();
		
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}else{
			return false;
		}
		
	}
	
	function changeAlertStatus($id){
		$id_arr = explode(',', urldecode($id));
		
		for ($i = 0; $i < count($id_arr); $i++){
			$details=array('status' => 2);
			$this->db->where('id',$id_arr[$i]);
			$this->db->update('notify_alert',$details);
		}
		return true;
	}
}
?>