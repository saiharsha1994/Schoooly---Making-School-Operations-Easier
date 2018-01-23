<?php
require(APPPATH.'/libraries/REST_Controller.php');

class AllContactList_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Allcontactlist_model');
		$this->load->database();
	}	
//	http://localhost/Hikmah/index.php/web_services/AllContactList_api/teachersList
	function teachersList_get()
    {
		$data = $this->Allcontactlist_model->getTeachersList();
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
	
	//	http://localhost/Hikmah/index.php/web_services/AllContactList_api/parentsList
	function parentsList_get()
    {
		$data = $this->Allcontactlist_model->getParentsList();
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_PARENTS;
            $this->response($ret_val, 404);
        }
	}
}
?>