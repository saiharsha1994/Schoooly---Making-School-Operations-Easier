<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Transport_Admin_Login_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Login_model');
		$this->load->database();
	}	
//	http://localhost/Tifly_Pro/index.php/web_services/Transport_Admin_Login_api/Login/Email/teacher@gmail.com/Password/test@123/GCM_RegId/1234
	function login_post()
    {
		$data = $this->Login_model->getTransAdminAuthendication($this->post('Email'),$this->post('Password'),$this->post('GCM_RegId'));
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
			$ret_val ['responsemsg'] = $data."Invalid username OR Password";
            $this->response($ret_val, 404);
        }
	}
	//	http://localhost/Tifly_Pro/index.php/web_services/Transport_Admin_Login_api/LoginPortal/Email/teacher@gmail.com/Password/test@123
	function loginPortal_post()
    {
		$data = $this->Login_model->getTransAdminPortalAuthendication($this->post('Email'),$this->post('Password'));
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
	
}
?>