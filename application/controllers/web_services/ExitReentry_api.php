<?php
require(APPPATH.'/libraries/REST_Controller.php');

class ExitReentry_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Exitreentry_model');
		$this->load->database();
	}	
//	http://localhost/Tifly_Pro/index.php/web_services/ExitReentry_api/listEntries/user_type/1/user_id/1
	function listEntries_get()
    {
		$data = $this->Exitreentry_model->getEntriesList($this->get('user_type'),$this->get('user_id'));
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
	
	//	http://localhost/Tifly_Pro/index.php/web_services/ExitReentry_api/addEntries
	function addEntries_post()
    {
		$details=array(
				'emp_id' => urldecode($this->post('emp_id')),
				'emp_type' => urldecode($this->post('emp_type')),
				'no_of_months' => urldecode($this->post('no_of_months')),
				'document' => urldecode($this->post('document')),
				'from_date' => urldecode($this->post('from_date')),
				'to_date' => urldecode($this->post('to_date')),
				'status' => 1);

		$data = $this->Exitreentry_model->addExitEntryDetails($details);
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
	function editEntries_post()
    {
		$details=array(
				'emp_id' => urldecode($this->post('emp_id')),
				'emp_type' => urldecode($this->post('emp_type')),
				'no_of_months' => urldecode($this->post('no_of_months')),
				'document' => urldecode($this->post('document')),
				'from_date' => urldecode($this->post('from_date')),
				'to_date' => urldecode($this->post('to_date')),
				'status' => 1,
				'added_on'=>date("Y-m-d h:i:s"));

		$data = $this->Exitreentry_model->editExitEntryDetails($details,$this->post('id'));
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