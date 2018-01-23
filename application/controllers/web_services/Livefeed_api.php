<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Livefeed_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Livefeed_model');
		$this->load->database();
	}	
//	http://localhost/Hikmah/index.php/web_services/Livefeed_Api/livefeed
	function livefeed_get()
    {
		$data = $this->Livefeed_model->getLivefeed();
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_POSTS;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Schoooly/index.php?web_services/Livefeed_Api/livefeedDelete/Post_Id/1
	function livefeedDelete_post()
    {
		$data = $this->Livefeed_model->DeleteFeedData($this->post('Post_Id'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "Deleted Successfully";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Not able to delete in ".TABLE_POSTS;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Schoooly/index.php/web_services/Livefeed_Api/livefeedInsert/Post_Title/ubg/Post_Descript/ghj/Post_Details/url/Post_Type/Image/Post_ById/2/Post_ByName/Teacher+2
	
	function livefeedInsert_post()
    {
		$data = $this->Livefeed_model->InsertData($this->post('Post_Title'),$this->post('Post_Descript'),$this->post('Post_Details'),$this->post('Post_Type'),$this->post('Post_ById'),$this->post('Post_ByName'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "Inserted Successfully";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Not able to Insert in ".TABLE_POSTS;
            $this->response($ret_val, 404);
        }
	}
}
?>