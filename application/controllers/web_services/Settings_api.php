<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Settings_api extends REST_Controller
{
	function __construct()	{
 		parent::__construct();
		$this->load->model('Settings_model');
		$this->load->database();
	}	
//	http://localhost/Tifly_Pro/index.php/web_services/Settings_api/listSettings
	function listSettings_get()    
	{		
		$data = $this->Settings_model->getSettingList();        
		if($data)        
		{			
			$ret_val ['responsecode'] = 1;			
			$ret_val ['result_arr'] = $data;			
			$ret_val ['responsemsg'] = "success";            
			$this->response($ret_val,200);        
		}else{
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "No records found ";
			$this->response($ret_val, 404);
		}	
	}

	//	http://localhost/Tifly_Pro/index.php/web_services/Settings_api/UpdateSettings/school_name/xx/system_title/ww/address/zz/phone/1234/location/243,234/speed_limit/23/school_fence/3	
	
	function UpdateSettings_post()
    {
		$details=array(
		'school_name' => urldecode($this->post('school_name')),
		'system_title' => urldecode($this->post('system_title')),
		'address' => urldecode($this->post('address')),
		'phone' => urldecode($this->post('phone')),
		'location' => urldecode($this->post('location')),
		'speed_limit' => urldecode($this->post('speed_limit')),	
		'school_fence' => urldecode($this->post('school_fence')));

		$data = $this->Settings_model->updateSettingsList($details);
        if($data)
		{			
			$ret_val ['responsecode'] = 1;
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
	//	http://localhost/Tifly_Pro/index.php/web_services/Settings_api/listRoles	
	
	function listRoles_get()
    {
		$data = $this->Settings_model->getHRRolesList();
        if($data){
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
}
?>