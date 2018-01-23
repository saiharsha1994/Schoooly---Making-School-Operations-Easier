<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Like_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Like_model');
		$this->load->database();
	}	
//	http://localhost/Hikmah/index.php/web_services/Like_api/likes
	function likes_get()
    {
		$data = $this->Like_model->getLikeList();
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_LIKE;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Hikmah/index.php/web_services/Like_api/likePost/Like_Status/1/Post_Id/1/Like_ById/1/Like_ByName/Thouseef
	function likePost_get()
    {
		$data = $this->Like_model->InsertData($this->get('Like_Status'),$this->get('Post_Id'),$this->get('Like_ById'),$this->get('Like_ByName'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "Inserted Successfully";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Not able to insert in ".TABLE_LIKE;
            $this->response($ret_val, 404);
        }
	}
}
?>