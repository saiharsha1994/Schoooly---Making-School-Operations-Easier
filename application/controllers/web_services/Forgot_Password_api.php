<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Forgot_Password_api extends REST_Controller
{
	function __construct(){
 		parent::__construct();
		$this->load->model('Forgot_model');
		$this->load->database();
	}	
//	http://localhost/Hikmah/index.php/web_services/Forgot_Password_api/forgot/Parent_Email/teacher@gmail.com
	function forgot_get()
    {
		if(!$this->get('Parent_Email'))
        {
            $ret_val ['responsecode'] = 5;
			$ret_val ['responsemsg'] = "Empty Params";
            $this->response($ret_val, 400);
        }
		
		$data = $this->Forgot_model->checkEmailAndSendMail($this->get('Parent_Email'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "success";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Invalid Email";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Hikmah/index.php/web_services/Forgot_Password_api/changePassword/Parent_Email/teacher@gmail.com/Auth_Code/123456/New_Password/test
	function changePassword_get()
    {
		$data = $this->Forgot_model->UpdatePassword($this->get('Parent_Email'),
									$this->get('Auth_Code'),$this->get('New_Password'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "success";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Invalid Email";
            $this->response($ret_val, 404);
        }
	}
	
	
	//	http://localhost/Hikmah/index.php/web_services/Forgot_Password_api/forgotTeacherPassword/Teacher_Email/teacher@gmail.com
	function forgotTeacherPassword_get()
    {
		if(!$this->get('Teacher_Email'))
        {
            $ret_val ['responsecode'] = 5;
			$ret_val ['responsemsg'] = "Empty Params";
            $this->response($ret_val, 400);
        }
		
		$data = $this->Forgot_model->checkEmailAndSendMail_Teacher($this->get('Teacher_Email'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "success";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Invalid Email";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Hikmah/index.php/web_services/Forgot_Password_api/changePasswordTeacher/Teacher_Email/teacher@gmail.com/Auth_Code/123456/New_Password/test
	function changePasswordTeacher_get()
    {
		$data = $this->Forgot_model->UpdatePassword_Teacher($this->get('Teacher_Email'),
									$this->get('Auth_Code'),$this->get('New_Password'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "success";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Invalid Email";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Hikmah/index.php/web_services/Forgot_Password_api/forgotTransportPassword/Email/teacher@gmail.com
	function forgotTransportPassword_get()
    {
		if(!$this->get('Email'))
        {
            $ret_val ['responsecode'] = 5;
			$ret_val ['responsemsg'] = "Empty Params";
            $this->response($ret_val, 400);
        }
		
		$data = $this->Forgot_model->checkEmailAndSendMail_Transport($this->get('Email'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "success";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Invalid Email";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Hikmah/index.php/web_services/Forgot_Password_api/changePasswordTransport/Email/teacher@gmail.com/Auth_Code/123456/New_Password/test
	function changePasswordTransport_get()
    {
		$data = $this->Forgot_model->UpdatePassword_Transport($this->get('Email'),
									$this->get('Auth_Code'),$this->get('New_Password'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "success";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Invalid Email";
            $this->response($ret_val, 404);
        }
	}
	/*
	//	http://localhost/Hikmah/index.php/web_services/Forgot_Password_api/forgotDriverPassword_get/Mobile/8015367897
	function forgotDriverPassword_get()
    {
		if(!$this->get('Mobile'))
        {
            $ret_val ['responsecode'] = 5;
			$ret_val ['responsemsg'] = "Empty Params";
            $this->response($ret_val, 400);
        }
		
		$data = $this->Forgot_model->checkEmailAndSendMail_Driver($this->get('Mobile'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "success";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Invalid Mobile";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Hikmah/index.php/web_services/Forgot_Password_api/changePasswordDriver/Mobile/8015367897/Auth_Code/123456/New_Password/test
	function changePasswordDriver_get()
    {
		$data = $this->Forgot_model->UpdatePassword_Driver($this->get('Mobie'),
									$this->get('Auth_Code'),$this->get('New_Password'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "success";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Invalid Mobile Number";
            $this->response($ret_val, 404);
        }
	}*/
}
?>