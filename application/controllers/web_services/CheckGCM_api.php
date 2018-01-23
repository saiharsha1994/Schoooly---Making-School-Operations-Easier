<?php
require(APPPATH.'/libraries/REST_Controller.php');

class CheckGCM_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Checkgcm_model');
		$this->load->database();
	}	
//	http://localhost/Hikmah/index.php/web_services/CheckGCM_api/check/User_Id/1/User_Type/Admin
	function check_get()
    {
		$data = $this->Checkgcm_model->checkUserAvailInGCM($this->get('User_Id'),$this->get('User_Type'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_GCM;
            $this->response($ret_val, 404);
        }
	}
}
?>