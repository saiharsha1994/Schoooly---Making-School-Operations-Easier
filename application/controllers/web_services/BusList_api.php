<?php
require(APPPATH.'/libraries/REST_Controller.php');

class BusList_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Buslist_model');
		$this->load->database();
	}	
//	http://localhost/Tifly_Pro/index.php/web_services/BusList_api/listBuses
	function listBuses_get()
    {
		$data = $this->Buslist_model->getbusList();
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

	//	http://localhost/Tifly_Pro/index.php/web_services/BusList_api/listSpareBuses
	function listSpareBuses_get()
    {
		$data = $this->Buslist_model->getSpareBusList();
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
	
	
	//	http://localhost/Tifly_Pro/index.php/web_services/BusList_api/addBuses/bus_name/R5/bus_type/10 seater/chassis_number/1/plate_number/123/fahas/123/bus_license/hh.pdf/license_expiry/2017-02-02/license_renewal_date/2017-02-02/MVPI/jj.pdf/MVPI_expiry/2017-02-02
		
	function addBuses_post()
    {
		$details=array(
				'name' => urldecode($this->post('bus_name')),
				'bus_type' => urldecode($this->post('bus_type')),
				'chassis_number' => urldecode($this->post('chassis_number')),
				'plate_number' => urldecode($this->post('plate_number')),
				'fahas' => urldecode($this->post('fahas')),
				'bus_license_upload' => urldecode($this->post('bus_license')),
				'license_expiry_date' => urldecode($this->post('license_expiry')),
				'license_renewal_date' => urldecode($this->post('license_renewal_date')),
				'MVPI_upload' => urldecode($this->post('MVPI')),
				'MVPI_expiry_date' => urldecode($this->post('MVPI_expiry'))
				);
							
		$data = $this->Buslist_model->addBusDetails($details);
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
	
	//	http://localhost/Tifly_Pro/index.php/web_services/BusList_api/editBuses/bus_name/R5/bus_type/40Seater/chassis_number/1/plate_number/123/fahas/123/bus_license/hh.pdf/license_expiry/2017-02-02/license_renewal_date/2017-02-02/MVPI/jj.pdf/MVPI_expiry/2017-02-02/bus_id/1
		
	function editBuses_post()
    {
		$details=array(
				'name' => urldecode($this->post('bus_name')),
				'bus_type' => urldecode($this->post('bus_type')),
				'chassis_number' => urldecode($this->post('chassis_number')),
				'plate_number' => urldecode($this->post('plate_number')),
				'fahas' => urldecode($this->post('fahas')),
				'bus_license_upload' => urldecode($this->post('bus_license')),
				'license_expiry_date' => urldecode($this->post('license_expiry')),
				'license_renewal_date' => urldecode($this->post('license_renewal_date')),
				'MVPI_upload' => urldecode($this->post('MVPI')),
				'MVPI_expiry_date' => urldecode($this->post('MVPI_expiry'))
				);
							
		$data = $this->Buslist_model->editBusDetails($details,$this->post('bus_id'));
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
	
	//	http://localhost/Tifly_Pro/index.php/web_services/BusList_api/deleteBus/bus_id/1
	function deleteBus_post()
    {
		$data = $this->Buslist_model->deleteBusDetails($this->post('bus_id'));
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
	
	//	http://localhost/Tifly_Pro/index.php/web_services/BusList_api/VechicleDistanceList
	function VechicleDistanceList_get()
    {
		$data = $this->Buslist_model->getBusDistance($this->get('bus_id'),$this->get('from_date'),$this->get('to_date'));
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
//	http://localhost/Tifly_Pro/index.php/web_services/BusList_api/reassignBus/from_bus_id/1/to_bus_id/2
	function reassignBus_post()
    {
		$data = $this->Buslist_model->reassignBusToSpareBus($this->post('from_bus_id'),$this->post('to_bus_id'));
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
}
?>