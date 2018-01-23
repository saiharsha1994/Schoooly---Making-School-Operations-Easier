<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Marksheet_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Marksheet_model');
		$this->load->database();
	}	
//	http://localhost/Tifly_Pro/index.php/web_services/Marksheet_api/listSemesters
	function listSemesters_get()
    {
		$data = $this->Marksheet_model->getSemesterList();
        if($data){
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr'] = $data;
			$ret_val ['responsemsg'] = "success";
            $this->response($ret_val,200);
        }
		else{
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "No records found ";
            $this->response($ret_val, 404);
        }
	}

//	http://localhost/Tifly_Pro/index.php/web_services/Marksheet_api/listExams
	function listExams_get()
    {
		$data = $this->Marksheet_model->getExamsList();
        if($data){
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr'] = $data;
			$ret_val ['responsemsg'] = "success";
            $this->response($ret_val,200);
        }
		else{
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "No records found ";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Tifly_Pro/index.php/web_services/Marksheet_api/listGrades
	function listGrades_get()
    {
		$data = $this->Marksheet_model->getGradesList();
        if($data){
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr'] = $data;
			$ret_val ['responsemsg'] = "success";
            $this->response($ret_val,200);
        }
		else{
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "No records found ";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Tifly_Pro/index.php/web_services/Marksheet_api/addSubjectMarks
	function addSubjectMarks_post()
    {
		$details=array(
				'student_id' => urldecode($this->post('student_id')),
				'subject_id' => urldecode($this->post('subject_id')),
				'class_id' => urldecode($this->post('class_id')),
				'section_id' => urldecode($this->post('section_id')),
				'exam_id' => urldecode($this->post('exam_id')),
				'mark_obtained' => urldecode($this->post('mark_obtained')));

		$data = $this->Marksheet_model->addSubjectMarksDetails($details);
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
	
	//	http://localhost/Tifly_Pro/index.php/web_services/Marksheet_api/addSubjectMarks
	function addClassMarks_post()
    {
		$details=array(
				'student_id' => urldecode($this->post('student_id')),
				'subject_id' => urldecode($this->post('subject_id')),
				'class_id' => urldecode($this->post('class_id')),
				'section_id' => urldecode($this->post('section_id')),
				'exam_id' => urldecode($this->post('exam_id')),
				'mark_obtained' => urldecode($this->post('mark_obtained')),
				'comment' => urldecode($this->post('comment')));

		$data = $this->Marksheet_model->addClassMarksDetails($details);
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
	
	//	http://localhost/Hikmah/index.php/web_services/Students_api/childMarksReport/exam_id/1/child_id/1
	function childMarksReport_get()
    {
		$data = $this->Marksheet_model->getChildMarksReport($this->get('exam_id'),$this->get('child_id'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_STUDENTS;
            $this->response($ret_val, 404);
        }
	}

}
?>