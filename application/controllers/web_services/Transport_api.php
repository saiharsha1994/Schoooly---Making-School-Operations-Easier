<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Transport_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Transport_model');
		$this->load->database();
	}	
//	http://localhost/Hikmah/index.php/web_services/Transport_api/details/Stu_Id/1
	function details_get()
    {
		$data = $this->Transport_model->getDetailsByStu_Id($this->get('Stu_Id'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_CLASS;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Hikmah/index.php/web_services/Transport_api/detailsForTeacher/teacher_id/1
	function detailsForTeacher_get()
    {
		$data = $this->Transport_model->getDetailsByTeacher_id($this->get('teacher_id'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_CLASS;
            $this->response($ret_val, 404);
        }
	}
}
?>