<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Comment_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Comment_model');
		$this->load->database();
	}	
//	http://localhost/Hikmah/index.php/web_services/Comment_Api/comments/Post_Id/1
	function comments_get()
    {
		$data = $this->Comment_model->getCommentList($this->get('Post_Id'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr'] = $data;
			$ret_val ['responsemsg'] = "success";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "No records found in ".TABLE_COMMENT;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Hikmah/index.php/web_services/Comment_Api/commentPost/Comment_Content/xyz/Comment_ById/1/Comment_ByName/Thouseef/Post_Id/1
	function commentPost_get()
    {
		$data = $this->Comment_model->InsertData($this->get('Comment_Content'),$this->get('Comment_ById'),$this->get('Comment_ByName'),$this->get('Post_Id'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "Inserted Successfully";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Not able to insert in ".TABLE_COMMENT;
            $this->response($ret_val, 404);
        }
	}
}
?>