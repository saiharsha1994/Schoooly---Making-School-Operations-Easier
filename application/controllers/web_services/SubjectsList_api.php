<?php
require(APPPATH.'/libraries/REST_Controller.php');

class SubjectsList_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Subjectslist_model');
		$this->load->database();
	}	
//	http://localhost/UIISR/index.php/web_services/SubjectsList_api/subjectList/Class_Id/1
	function subjectList_get()
    {
		$data = $this->Subjectslist_model->getsubjectList($this->get('Class_Id'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_SUBJECTS;
            $this->response($ret_val, 404);
        }
	}
}
?>