<?php
class Livefeed_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	function getLivefeed()
	{
		$q = $this->db->query('SELECT  Post_Id,Post_Title,Post_Descript,Post_Details,Post_Type,Post_ById,Post_ByName,Comment_Count,Like_Count,Post_Time FROM '.TABLE_POSTS);
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function InsertData($Post_Title,$Post_Descript,$Post_Details,$Post_Type,$Post_ById,$Post_ByName)
	{
		$urls = str_replace('|', '/', urldecode($Post_Details));
		$dataArr = array(
			'Post_Title' => urldecode($Post_Title),
			'Post_Descript' => urldecode($Post_Descript),
			'Post_Details' => $urls,
			'Post_Type' => $Post_Type,
			'Post_ById' => $Post_ById,
			'Post_ByName' => urldecode($Post_ByName));

		if($this->db->insert(TABLE_POSTS, $dataArr))
		{
			return 'Success';
		}
	}
	
	function DeleteFeedData($Post_Id)
	{
		if($this->db->delete(TABLE_POSTS, array('Post_Id' => $Post_Id)))
		{
			return 'Success';
		}
	}
}
?>