<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Fees_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Fees_model');
		$this->load->database();
	}	
//	http://localhost/UIISR/index.php/web_services/Fees_api/feesPendingDetails/Student_Id/1
	function feesPendingDetails_get()
    {
		$data = $this->Fees_model->getFeesDetails($this->get('Student_Id'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_FEE_PENDING;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/UIISR/index.php/web_services/Fees_api/feesPaidDetails/Student_Id/1
	function feesPaidDetails_get()
    {
		$data = $this->Fees_model->getFeesPaidDetails($this->get('Student_Id'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_FEE_INVOICE;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Schoooly/index.php?web_services/Fees_api/bankReceipt/pending_id/1/amount/100/receipt/url
	function bankReceipt_post()
    {
		$data = $this->Fees_model->postBankReceipt($this->post('pending_id'),$this->post('amount'),$this->post('receipt'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "success";
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