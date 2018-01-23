<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Classes_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Classes_model');
		$this->load->database();
	}	
//	http://localhost/Hikmah/index.php/web_services/Classes_api/classes
	function classes_get()
    {
		$data = $this->Classes_model->getClassList();
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
	
	//	http://localhost/Hikmah/index.php/web_services/Classes_api/sections
	function sections_get()
    {
		$data = $this->Classes_model->getSectionList();
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_SECTION;
            $this->response($ret_val, 404);
        }
	}
}
?>