<?php
require(APPPATH.'/libraries/REST_Controller.php');

class PettyCash_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Pettycash_model');
		$this->load->database();
	}	
//	http://localhost/Schoooly/index.php/web_services/PettyCash_api/listPettycash/from_date/2017-03-01/to_date/2017-03-30/driver_id/1/for/fuel/pc_id/1
	function listPettycash_get()
    {
		$data = $this->Pettycash_model->getPettyCashList($this->get('from_date'),$this->get('to_date'),$this->get('driver_id'),$this->get('for'),$this->get('pc_id'));
		
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
	
	/*function listPettycash_get()
    {
		$data = $this->Pettycash_model->getPettyCashList($this->get('for'));
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
	*/
	
	//	http://localhost/Schoooly/index.php/web_services/PettyCash_api/addPettyCash/date/2017-01-02/driver_id/1/amount_given/220/amount_for/fuel
		
	function addPettyCash_post()
    {
		$details=array(
				'date' => urldecode($this->post('date')),
				'driver_id' => urldecode($this->post('driver_id')),
				'amount_given' => urldecode($this->post('amount_given')),
				'amount_for' => urldecode($this->post('amount_for')),
				'amount_spend' => '',
				'balance' => '',
				'invoice_doc' => ''
				);
							
		$data = $this->Pettycash_model->addDetails($details);
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
	
	//	http://localhost/Schoooly/index.php/web_services/BusList_api/editPettyCash/date/2017-01-02/driver_id/1/amount_given/220/amount_spend/200/balance/20/invoice_doc/filename.pdf/pc_id/2
	function editPettyCash_post()
    {
		$details=array(
				'date' => urldecode($this->post('date')),
				'driver_id' => urldecode($this->post('driver_id')),
				'amount_given' => urldecode($this->post('amount_given')),
				'amount_spend' => urldecode($this->post('amount_spend')),
				'balance' => urldecode($this->post('balance')),
				'amount_for' => urldecode($this->post('amount_for')),
				'invoice_doc' => urldecode($this->post('invoice_doc'))
				);
							
		$data = $this->Pettycash_model->editBusDetails($details,$this->post('pc_id'));
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
	
	//	http://localhost/Schoooly/index.php/web_services/BusList_api/deletePettyCash/pc_id/1
	function deletePettyCash_post()
    {
		$data = $this->Pettycash_model->deletePettyCashDetails($this->post('pc_id'));
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
	
	//	http://localhost/Schoooly/index.php/web_services/PettyCash_api/listPettycashForDriver/driver_id/1/for/fuel
	function listPettycashForDriver_get()
    {
		$data = $this->Pettycash_model->getDriverPettyCashList($this->get('for'),$this->get('driver_id'));
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
	
	//	http://localhost/Schoooly/index.php/web_services/PettyCash_api/listPettycashForDriverByDate/driver_id/1/from_date/2017-01-01/to_date/2017-01-01/for/fuel
	function listPettycashForDriverByDate_get()
    {
		$data = $this->Pettycash_model->getDriverPettyCashListByDate($this->get('driver_id'),$this->get('from_date'),$this->get('to_date'),$this->get('for'));
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
}
?>