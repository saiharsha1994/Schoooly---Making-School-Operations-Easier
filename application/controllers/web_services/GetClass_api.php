<?php
require(APPPATH.'/libraries/REST_Controller.php');

class GetClass_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Getclass_model');
		$this->load->database();
	}	
//	http://localhost/UIISR/index.php/web_services/GetClass_api/getClassId/student_id/1
	function getClassId_get()
    {
		$data = $this->Getclass_model->getClassID($this->get('student_id'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_ENROLL;
            $this->response($ret_val, 404);
        }
	}
}
?>