<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Students_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Student_model');
		$this->load->database();
		$this->load->library('GCM');
	}	
//	http://localhost/Hikmah/index.php/web_services/Students_api/students/Class_Id/1/Section_Id/1
	function students_get()
    {
		$data = $this->Student_model->getStudentList($this->get('Class_Id'),$this->get('Section_Id'));
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
	
	//	http://localhost/Tifly_Pro/index.php/web_services/Students_api/studentsByBus/Bus_Id/1
	function studentsByBus_get()
    {
		$data = $this->Student_model->getStudentListByBusId($this->get('Bus_Id'));
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
			$ret_val ['responsemsg'] = "No records found";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Tifly_Pro/index.php/web_services/Students_api/studentsByRoute/trip_type/1/route_id/11
	function studentsByRoute_get()
    {
		$data = $this->Student_model->getStudentListByRouteId($this->get('trip_type'),$this->get('route_id'));
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
			$ret_val ['responsemsg'] = "No records found";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Tifly_Pro/index.php/web_services/Students_api/studentsAttendanceByRoute/route_id/11/user_type/1
	//1--> Student ; 2 --> teacher
	function studentsAttendanceByRoute_get()
    {
		$data = $this->Student_model->getStudentsAttendanceByRoute($this->get('route_id'),$this->get('user_type'));
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
			$ret_val ['responsemsg'] = "No records found";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Tifly_Pro/index.php/web_services/Students_api/onlyStudentsByBus/Bus_Id/1
	function onlyStudentsByBus_get()
    {
		$data = $this->Student_model->getOnlyStudentListByBusId($this->get('Bus_Id'));
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
			$ret_val ['responsemsg'] = "No records found";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Hikmah/index.php/web_services/Students_api/allStudents/trip_type/1
	function allStudents_get()
    {
		$data = $this->Student_model->getAllStudentList($this->get('trip_type'));
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

	//	http://localhost/Hikmah/index.php/web_services/Students_api/allTeachers
	function allTeachers_get()
    {
		$data = $this->Student_model->getAllTeachersList();
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
	//	http://localhost/Hikmah/index.php/web_services/Students_api/updateStudentRadius/trip_type/pickup/radius/1/parent_id/1
	function updateStudentRadius_get()
    {
		$data = $this->Student_model->updateRadius($this->get('trip_type'),$this->get('radius'),$this->get('parent_id'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
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
	//	http://localhost/Tifly_Pro/index.php?web_services/Students_api/updateCoordinates/Lat/42.2222/Lang/24.545/parent_id/1/Stu_Name/Sajib/Street_Name/xxxx/Area/yyy/Landmark/zzzz/Lanmark_url/url
	function updateCoordinates_post()
    {
		$data = $this->Student_model->updateCoordinatesByStuId($this->post('Lat'),$this->post('Lang'),$this->post('parent_id'),$this->post('Street_Name'),$this->post('Area'),$this->post('Landmark'),$this->post('Lanmark_url'));
        if($data)
        {
			//Inform Transport admin about the new address update of students/Class_Id/1/Section_Id/1
			$query = $this->db->query("SELECT GCM_RegId FROM ".TABLE_GCM." WHERE User_Type='transport'");
			if($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					$this->gcm->addRecepient($row['GCM_RegId']);
				}	
				$message = array("Notification" => "Hi Admin,".$this->post('Stu_Name')."'s Parent has changed his drop address Kindly check it." ,"image_url" => "");
				$this->gcm->setData($message);
				$Type='transport';
				$this->gcm->send($Type);
			}
		
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "success";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Failed to update";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Hikmah/index.php/web_services/Students_api/updateStudentOutbox/trip_type/1/route_id/1/student_id/1/student_name/xxx/user_type/student
	function updateStudentOutbox_post()
    {
		$data = $this->Student_model->updateStudentAttendace($this->post('trip_type'),$this->post('route_id'),$this->post('student_id'),$this->post('student_name'),$this->post('user_type'));
        if($data)
        {
			$Attquery=$this->db->query("SELECT GCM_RegId FROM app_gcm_parents WHERE User_Type='parent' 
			AND User_Id IN (SELECT parent_id FROM student WHERE student_id=".$this->post('student_id').")");
			
			if($Attquery->num_rows() > 0) {
				foreach ($Attquery->result_array() as $row) {
					$message = array("Notification" => "Hi, Your child ".$this->post('student_name')." is going back to home.".date("Y-m-d h:m:s") ,"image_url" => "");	
					$this->gcm->clearRecepient();
					$this->gcm->addRecepient($row['GCM_RegId']);
					$this->gcm->setData($message);
					$Type='parent';
					$this->gcm->send($Type);
				}
			}
			$ret_val ['responsecode'] = 1;
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

	//	http://localhost/Hikmah/index.php/web_services/Students_api/OutboxByTeacher/student_id/1/student_name/xxx
	function OutboxByTeacher_post()
    {
		$data = $this->Student_model->updateStudentOutAttendaceByTeacher($this->post('student_id'),$this->post('student_name'));
        if($data)
        {
			$Attquery=$this->db->query("SELECT GCM_RegId FROM app_gcm_parents WHERE User_Type='parent' 
			AND User_Id IN (SELECT parent_id FROM student WHERE student_id=".$this->post('student_id').")");
			
			if($Attquery->num_rows() > 0) {
				foreach ($Attquery->result_array() as $row) {
					$message = array("Notification" => "Hi, Your child ".$this->post('student_name')." is going back to home.".date("Y-m-d h:m:s") ,"image_url" => "");	
					//$this->gcm->clearRecepient();
					$this->gcm->addRecepient($row['GCM_RegId']);
					$this->gcm->setData($message);
					$Type='parent';
					$this->gcm->send($Type);
				}
			}
			$ret_val ['responsecode'] = 1;
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
	
	//	http://localhost/Hikmah/index.php/web_services/Students_api/updateStudentAttendaceByAdmin/trip_type/1/route_id/1/student_id/1/student_name/xxx/user_type/student/in_status/1/out_status/1
	function updateStudentAttendaceByAdmin_post()
    {
		$data = $this->Student_model->updateAttendaceByAdmin($this->post('trip_type'),$this->post('route_id'),$this->post('student_id'),$this->post('student_name'),$this->post('user_type'),$this->post('in_status'),$this->post('out_status'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
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
	
	//	http://localhost/Hikmah/index.php/web_services/Students_api/classMarks/Class_Id/1/Section_Id/1
	function classMarks_get()
    {
		$data = $this->Student_model->getMarklistByClass($this->get('Class_Id'),$this->get('Section_Id'));
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
	
	//	http://localhost/Hikmah/index.php/web_services/Students_api/classMarksReport/Class_Id/1/Section_Id/1
	function classMarksReport_get()
    {
		$data = $this->Student_model->getMarklistReportByClass($this->get('Class_Id'),$this->get('Section_Id'));
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
