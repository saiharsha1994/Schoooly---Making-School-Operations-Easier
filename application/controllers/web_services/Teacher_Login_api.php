<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Teacher_Login_Api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Login_model');
		$this->load->database();
	}	
//	http://localhost/Hikmah/index.php/web_services/Teacher_Login_Api/Login/Email/teacher@gmail.com/Pass_Word/test@123/GCM_RegId/1234
	function login_get()
    {
		if(!$this->get('Email') || !$this->get('Pass_Word') )
        {
            $ret_val ['responsecode'] = 5;
			$ret_val ['responsemsg'] = "Empty Params";
            $this->response($ret_val, 400);
        }
		
		$data = $this->Login_model->getTeacherAuthendication($this->get('Email'),$this->get('Pass_Word'),$this->get('GCM_RegId'));
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