<?php
class Like_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function getLikeList()
	{
		$q = $this->db->query('SELECT Like_Id,Like_Status,Like_ById,Like_ByName,Post_Id,Liked_On FROM '.TABLE_LIKE);
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function InsertData($Like_Status,$Post_Id,$Like_ById,$Like_ByName)
	{
		$dataArr = array(
			'Like_Status' => $Like_Status,
			'Like_ById' => $Like_ById,
			'Like_ByName' => urldecode($Like_ByName),
			'Post_Id' => $Post_Id);

		if($this->db->insert(TABLE_LIKE, $dataArr))
		{
			$this->db->where('Post_Id', $Post_Id);
			$this->db->set('Like_Count', 'Like_Count+1', FALSE);
			if($this->db->update(TABLE_POSTS)){
				return 'Success';	
			}
		}		
	}
}
?>