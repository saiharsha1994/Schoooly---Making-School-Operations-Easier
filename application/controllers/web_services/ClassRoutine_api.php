<?php
require(APPPATH.'/libraries/REST_Controller.php');

class ClassRoutine_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Classroutine_model');
		$this->load->database();
	}	
//	http://localhost/UIISR/index.php/web_services/ClassRoutine_api/classRoutine/Class_Id/1/Section_Id/1
	function classRoutine_get()
    {
		$data = $this->Classroutine_model->getClassRoutine($this->get('Class_Id'),$this->get('Section_Id'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_CLASS_ROUTINE;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/UIISR/index.php/web_services/ClassRoutine_api/classRoutineForTeacher/Teacher_Id/1
	function classRoutineForTeacher_get()
    {
		$data = $this->Classroutine_model->getTeacherClassRoutine($this->get('Teacher_Id'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_CLASS_ROUTINE;
            $this->response($ret_val, 404);
        }
	}
}
?>