<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Syllabus_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Syllabus_model');
		$this->load->database();
	}	
//	http://localhost/UIISR/index.php/web_services/Syllabus_api/syllabus/class_id/1
	function syllabus_get()
    {
		$data = $this->Syllabus_model->getSyllabus($this->get('class_id'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_ACADEMIC_SYLLABUS;
            $this->response($ret_val, 404);
        }
	}

//	http://localhost/UIISR/index.php/web_services/Syllabus_api/completed_academic/class_id/1/section_id/1/subject_id/1
	function completed_academic_get()
    {
		$data = $this->Syllabus_model->getCompleted_academic($this->get('class_id'),$this->get('section_id'),$this->get('subject_id'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_ACADEMIC_SYLLABUS;
            $this->response($ret_val, 404);
        }
	}	
	
	//	http://localhost/UIISR/index.php/web_services/Syllabus_api/teacher_academic/day/2/class_id/1/section_id/1/subject_id/1
	function teacher_academic_get()
    {
		$data = $this->Syllabus_model->getTeacher_academic($this->get('day'),$this->get('class_id'),$this->get('section_id'),$this->get('subject_id'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_ACADEMIC_SYLLABUS;
            $this->response($ret_val, 404);
        }
	}	
	
	//	http://localhost/UIISR/index.php/web_services/Syllabus_api/update_academic/sno/1/teacher_id/1/completed_on/2014-08-12
	function update_academic_post()
    {
		$data = $this->Syllabus_model->updateTeacher_academic($this->post('sno'),$this->post('teacher_id'),$this->post('completed_on'),$this->post('from_page'),$this->post('to_page'));
		if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "success";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "No records found in ".TABLE_ACADEMIC_SYLLABUS;
            $this->response($ret_val, 404);
        }
	}	

	//http://localhost/UIISR/index.php/web_services/Syllabus_api/completed_teach_plan/from_date/2017-04-01/to_date/2017-04-04/class_id/1/section_id/1/subject_id/1
	function completed_teach_plan_get()
    {
		$data = $this->Syllabus_model->getCompletedTeachPlan($this->get('from_date'),$this->get('to_date'),$this->get('class_id'),$this->get('section_id'),$this->get('subject_id'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_ACADEMIC_SYLLABUS;
            $this->response($ret_val, 404);
        }
	}
	//	http://localhost/UIISR/index.php/web_services/Syllabus_api/studyMaterial/class_id/1
	function studyMaterial_get()
    {
		$data = $this->Syllabus_model->getStudyMaterial($this->get('class_id'));
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
	
	// //	http://localhost/UIISR/index.php/web_services/Syllabus_api/books/Class_Id/1
	// function books_get()
    // {
		// $data = $this->Syllabus_model->getbooks($this->get('Class_Id'));
        // if($data)
        // {
			// $ret_val ['responsecode'] = 1;
			// $ret_val ['result_arr'] = $data;
			// $ret_val ['responsemsg'] = "success";
            // $this->response($ret_val,200);
        // }
		// else
        // {
			// $ret_val ['responsecode'] = 2;
			// $ret_val ['responsemsg'] = "No records found in ".TABLE_TOPICS;
            // $this->response($ret_val, 404);
        // }
	// }

}
?>