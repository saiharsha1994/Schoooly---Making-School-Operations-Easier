<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Parent_Login_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Login_model');
		$this->load->database();
	}	
//	http://localhost/UIISR/index.php/web_services/Parent_Login_api/Login/Parent_Email/teacher@gmail.com/Pass_Word/test@123/GCM_RegId/1234
	function login_post()
    {
		if(!$this->post('Parent_Email') || !$this->post('Pass_Word') )
        {
			//$this->response(_$SERVER);
            $ret_val ['responsecode'] = 5;
			$ret_val ['responsemsg'] = "Empty Params";
            $this->response($ret_val, 400);
        }		
		$data = $this->Login_model->getParentAuthendication($this->post('Parent_Email'),$this->post('Pass_Word'),$this->post('GCM_RegId'));
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
			$ret_val ['responsemsg'] = "Invalid username OR Password";
            $this->response($ret_val, 404);
        }
	}
	//	http://localhost/UIISR/index.php/web_services/Parent_Login_api/childIDs/parent_id/1
	function childIDs_get()
    {
		$data = $this->Login_model->getChildNameID($this->get('parent_id'));
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
			$ret_val ['responsemsg'] = "No records found";
            $this->response($ret_val, 404);
        }
	}
	
}
?>