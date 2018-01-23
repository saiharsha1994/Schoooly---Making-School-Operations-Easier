<?php
class Comment_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function getCommentList($Post_Id)
	{
		$q = $this->db->query('SELECT Comment_Id,Comment_Content,Comment_ById,Comment_ByName,Post_Id,Comment_On FROM '.TABLE_COMMENT.' WHERE Post_Id='.$Post_Id);
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function InsertData($Comment_Content,$Comment_ById,$Comment_ByName,$Post_Id)
	{
		$dataArr = array(
			'Comment_Content' => urldecode($Comment_Content),
			'Comment_ById' => $Comment_ById,
			'Comment_ByName' => urldecode($Comment_ByName),
			'Post_Id' => $Post_Id);
		if($this->db->insert(TABLE_COMMENT, $dataArr))
		{
			$this->db->where('Post_Id', $Post_Id);
			$this->db->set('Comment_Count', 'Comment_Count+1', FALSE);
			if($this->db->update(TABLE_POSTS)){
				return 'Success';	
			}
		}		
	}
}
?>