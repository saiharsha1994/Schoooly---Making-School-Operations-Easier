<?php
require(APPPATH.'/libraries/REST_Controller.php');

class DriverList_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Driverlist_model');
		$this->load->database();
	}	
//	http://localhost/Tifly_Pro/index.php/web_services/DriversList_api/listDrivers
	function listDrivers_get()
    {
		$data = $this->Driverlist_model->getdriverList();
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
	
	//	http://localhost/Tifly_Pro/index.php/web_services/DriversList_api/driverMeritSystem/month/March
	function driverMeritSystem_get()
    {
		$data = $this->Driverlist_model->getDriverMerits($this->get('month'));
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
	
	//	http://localhost/Tifly_Pro/index.php/web_services/DriversList_api/addDriverMeritReview/Driver_Id/1/Driver_Name/abu/speed/5/rash_driving/5/time_maintain/5/parent_id/1
	
	function addDriverMeritReview_get()
    {
		$cur_Date = date("Y-m-d");
		$cur_month = date("F");
		$details=array(
			'driver_id' => urldecode($this->get('Driver_Id')),
			'driver_name' => urldecode($this->get('Driver_Name')),
			'parent_id' => urldecode($this->get('parent_id')),
			'review_date' => $cur_Date,
			'review_month' => $cur_month,
			'speed_limit' => urldecode($this->get('speed')),
			'rash_driving' => urldecode($this->get('rash_driving')),
			'time_maitanance' => urldecode($this->get('time_maintain')));
				
		$data = $this->Driverlist_model->addDriverMerits($details);
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
	
	//	http://localhost/Tifly_Pro/index.php/web_services/DriverList_api/DriverDetailsByStudent/stu_id/1|2
	function DriverDetailsByStudent_get(){
		$data = $this->Driverlist_model->getDriverDetailsByStud($this->get('stu_id'));
        if($data){
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr'] = $data;
			$ret_val ['responsemsg'] = "success";
            $this->response($ret_val,200);
        }
		else{
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "No records found ";
            $this->response($ret_val, 404);
        }
	}
	
	
	
	//	http://localhost/Tifly_Pro/index.php/web_services/DriverList_api/addDrivers/name/R5/nationality/10 seater/iqama_number/1/iqama_expiry_date/123/passport_number/123/passport_expiry_date/hh.pdf/mobile/2017-02-02/password/2017-02-02/photo/jj.pdf/assigned_bus/1/iqama_upload/sdd.pdf/license_upload/ss.pdf/passport_upload/sds.pdf/license_number/sdsds/license_expiry_date/2017-01-09
	function addDrivers_post()
    {
		$details=array(
				'name' => urldecode($this->post('name')),
				'nationality' => urldecode($this->post('nationality')),
				'iqama_number' => urldecode($this->post('iqama_number')),
				'iqama_expiry_date' => urldecode($this->post('iqama_expiry_date')),
				'passport_number' => urldecode($this->post('passport_number')),
				'passport_expiry_date' => urldecode($this->post('passport_expiry_date')),
				'mobile' => urldecode($this->post('mobile')),
				'password' => urldecode($this->post('password')),
				'photo' => urldecode($this->post('photo')),
				'iqama_upload' => urldecode($this->post('iqama_upload')),
				'license_upload' => urldecode($this->post('license_upload')),
				'passport_upload' => urldecode($this->post('passport_upload')),
				'license_number' => urldecode($this->post('license_number')),
				'license_expiry_date' => urldecode($this->post('license_expiry_date')),
				'assigned_bus' => urldecode($this->post('assigned_bus'))
				);
							
		$data = $this->Driverlist_model->addDriverDetails($details);
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
	
	//	http://localhost/Tifly_Pro/index.php/web_services/DriverList_api/editDrivers/name/R5/nationality/10 seater/iqama_number/1/iqama_expiry_date/123/passport_number/123/passport_expiry_date/hh.pdf/mobile/2017-02-02/password/2017-02-02/photo/jj.pdf/assigned_bus/1/iqama_upload/sdd.pdf/license_upload/ss.pdf/passport_upload/sds.pdf/license_number/sdsds/license_expiry_date/2017-01-09/driver_id/10
		
	function editDrivers_post()
    {
		$details=array(
				'name' => urldecode($this->post('name')),
				'nationality' => urldecode($this->post('nationality')),
				'iqama_number' => urldecode($this->post('iqama_number')),
				'iqama_expiry_date' => urldecode($this->post('iqama_expiry_date')),
				'passport_number' => urldecode($this->post('passport_number')),
				'passport_expiry_date' => urldecode($this->post('passport_expiry_date')),
				'mobile' => urldecode($this->post('mobile')),
				'password' => urldecode($this->post('password')),
				'photo' => urldecode($this->post('photo')),
				'iqama_upload' => urldecode($this->post('iqama_upload')),
				'license_upload' => urldecode($this->post('license_upload')),
				'passport_upload' => urldecode($this->post('passport_upload')),
				'license_number' => urldecode($this->post('license_number')),
				'license_expiry_date' => urldecode($this->post('license_expiry_date')),
				'assigned_bus' => urldecode($this->post('assigned_bus'))
				);
							
		
		$data = $this->Driverlist_model->editDriverDetails($details,$this->post('driver_id'));
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
	
	//	http://localhost/Tifly_Pro/index.php/web_services/DriverList_api/deleteDriver/driver_id/4
	function deleteDriver_post()
    {
		$data = $this->Driverlist_model->deleteDriverDetails($this->post('driver_id'));
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