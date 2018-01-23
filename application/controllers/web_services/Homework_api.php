<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Homework_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Homework_model');
		$this->load->database();
	}	
//	http://localhost/UIISR/index.php/web_services/Homework_api/homework/Class_Id/1/Section_Id/1
	function homework_get()
    {
		$data = $this->Homework_model->getHomework($this->get('Class_Id'),$this->get('Section_Id'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_HOMEWORK;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/UIISR/index.php/web_services/Homework_api/homeworkForTeacher/Teacher_Id/1
	function homeworkForTeacher_get()
    {
		$data = $this->Homework_model->getHomeworkForTeacher($this->get('Teacher_Id'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_HOMEWORK;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/UIISR/index.php/web_services/Homework_api/assignment/Class_Id/1/Section_Id/1
	function assignment_get()
    {
		$data = $this->Homework_model->getAssignment($this->get('Class_Id'),$this->get('Section_Id'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_HOMEWORK;
            $this->response($ret_val, 404);
        }
	}
}
?>