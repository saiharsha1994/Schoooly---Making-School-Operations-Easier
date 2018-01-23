<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Contracts_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Contract_model');
		$this->load->database();
	}	
//	http://localhost/Tifly_Pro/index.php/web_services/Contracts_api/listContract
	function listContract_get()
    {
		$data = $this->Contract_model->getContractList();
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
	
	//	http://localhost/Tifly_Pro/index.php/web_services/Contracts_api/addContract/vendor_name/R5/vendor_email/1/contract_date/123/vendor_mobile/123/busses_provide/2/driver_provide/2/expiry_date/2017-02-02/addtional_details/sdsd/document/sdsd
	function addContract_post()
    {
		$details=array(
				'vendor_name' => urldecode($this->post('vendor_name')),
				'vendor_email' => urldecode($this->post('vendor_email')),
				'contract_date' => urldecode($this->post('contract_date')),
				'vendor_mobile' => urldecode($this->post('vendor_mobile')),
				'busses_provide' => urldecode($this->post('busses_provide')),
				'driver_provide' => urldecode($this->post('driver_provide')),
				'expiry_date' => urldecode($this->post('expiry_date')),
				'addtional_details' => urldecode($this->post('addtional_details')),
				'document' => urldecode($this->post('document'))
				);

		$data = $this->Contract_model->addContractDetails($details);
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
	
	//	http://localhost/Tifly_Pro/index.php/web_services/BusList_api/addContract/vendor_name/R5/vendor_email/1/contract_date/123/vendor_mobile/123/busses_provide/2/driver_provide/2/expiry_date/2017-02-02/addtional_details/sdsd/document/sdsd/contract_id/1
	function EditContract_post()
    {
		$details=array(
				'vendor_name' => urldecode($this->post('vendor_name')),
				'vendor_email' => urldecode($this->post('vendor_email')),
				'contract_date' => urldecode($this->post('contract_date')),
				'vendor_mobile' => urldecode($this->post('vendor_mobile')),
				'busses_provide' => urldecode($this->post('busses_provide')),
				'driver_provide' => urldecode($this->post('driver_provide')),
				'expiry_date' => urldecode($this->post('expiry_date')),
				'addtional_details' => urldecode($this->post('addtional_details')),
				'document' => urldecode($this->post('document'))
				);

		$data = $this->Contract_model->editContractDetails($details,$this->post('contract_id'));
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

	//	http://localhost/Tifly_Pro/index.php/web_services/BusList_api/deleteContract/contract_id/1
	function deleteContract_post()
    {
		$data = $this->Contract_model->deleteContractDetails($this->post('contract_id'));
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