<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Driver_Login_Api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Login_model');
		$this->load->database();
	}	
//	http://localhost/Tifly_Pro/index.php/web_services/Driver_Login_Api/Login/Mobile/8015367897/Password/test@123
	function login_get()
    {
		if(!$this->get('Mobile') || !$this->get('Password') )
        {
            $ret_val ['responsecode'] = 5;
			$ret_val ['responsemsg'] = "Empty Params";
            $this->response($ret_val, 400);
        }
		
		//$this->load->library('ApiCrypter');
		$data = $this->Login_model->getDriverAuthendication($this->get('Mobile'),$this->get('Password'));
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