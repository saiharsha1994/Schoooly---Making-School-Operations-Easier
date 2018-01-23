<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Curriculum_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Curriculum_model');
		$this->load->database();
		$this->load->library('GCM');
	}	
//http://localhost/Hikmah/index.php/web_services/Curriculum_api/curriculumList
	function curriculumList_get()
    {
		$data = $this->Curriculum_model->getCurriculum();
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_CURRICULUM;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Hikmah/index.php/web_services/Curriculum_api/insertCurriculum/Cur_Title/TestTitle/Cur_Desc/Test Description/Sub_Type/English/Prg_Type/preschool
	function insertCurriculum_get()
    {
		$data = $this->Curriculum_model->InsertData($this->get('Cur_Title'),$this->get('Cur_Desc'),$this->get('Sub_Type'),$this->get('Prg_Type'));
        if($data)
        {
			$query = $this->db->query("SELECT GCM_RegId FROM ".TABLE_GCM." WHERE User_Type='Parent'");
			if($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					$this->gcm->addRecepient($row['GCM_RegId']);
				}
				$message = array("Notification" => "Assalamu’alaikum! Curriculm have been updated in the app." ,"image_url" => "");	
				$this->gcm->setData($message);
				$Type='Parent';
				$this->gcm->send($Type);
			}
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "Inserted Successfully";
			$this->response($ret_val,200);			
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Not able to insert in ".TABLE_CURRICULUM;
            $this->response($ret_val, 404);
        }
	}
	
	//http://localhost/Hikmah/index.php/web_services/Curriculum_api/curriculumDelete/Cur_Id/1
	function curriculumDelete_get()
    {
		$data = $this->Curriculum_model->deleteCurriculum($this->get('Cur_Id'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "Deleted Successfully";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Not able to delete in ".TABLE_CURRICULUM;
            $this->response($ret_val, 404);
        }
	}
}

?>