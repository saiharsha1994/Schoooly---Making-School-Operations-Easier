<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Parent_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Parent_model');
		$this->load->database();
	}	
//	http://localhost/Schoooly/index.php/web_services/Parent_api/listParents
	function listParents_get()
    {
		$data = $this->Parent_model->getParentList();
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
			$ret_val ['responsemsg'] = "No records found ";
            $this->response($ret_val, 404);
        }
	}
	
	
	//	http://localhost/Schoooly/index.php/web_services/Parent_api/addParent/Name/Thosueef/Email/th@gmail.com/Password/sdfsfsf/Phone/112233/Profession/SE/Address/adsad
		
	function addParent_get()
    {
		$details=array(
				'name' => urldecode($this->get('Name')),
				'email' => urldecode($this->get('Email')),
				'password' => urldecode($this->get('Password')),
				'phone' => urldecode($this->get('Phone')),
				'address' => urldecode($this->get('Address')),
				'profession' => urldecode($this->get('Profession'))
				);
							
		$data = $this->Parent_model->addDetails($details);
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Failed";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Schoooly/index.php/web_services/Parent_api/addParent/Name/Thosueef/Email/th@gmail.com/Password/sdfsfsf/Phone/112233/Profession/SE/Address/adsad/Parent_id/1
	function editParent_get()
    {
		$details=array(
				'name' => urldecode($this->get('Name')),
				'email' => urldecode($this->get('Email')),
				'password' => urldecode($this->get('Password')),
				'phone' => urldecode($this->get('Phone')),
				'address' => urldecode($this->get('Address')),
				'profession' => urldecode($this->get('Profession'))
				);
							
		$data = $this->Parent_model->editDetails($details,$this->get('Parent_id'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Failed";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Schoooly/index.php/web_services/Parent_api/deleteParent/Parent_id/1
	function deleteParent_get()
    {
		$data = $this->Parent_model->deleteParentDetails($this->get('Parent_id'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Failed";
            $this->response($ret_val, 404);
        }
	}
	
}
?>