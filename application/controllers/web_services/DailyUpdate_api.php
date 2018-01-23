<?php
require(APPPATH.'/libraries/REST_Controller.php');

class DailyUpdate_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('DailyUpdate_model');
		$this->load->database();
		$this->load->library('GCM');
	}	
//	http://localhost/UIISR/index.php/web_services/DailyUpdate_api/updates/Class_Id/1/Section_Id/1
	function updates_get()
    {
		$data = $this->DailyUpdate_model->getUpdates($this->get('Class_Id'),$this->get('Section_Id'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_UPDATES;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/UIISR/index.php/web_services/DailyUpdate_api/insertUpdates/Class_Id/1/Section_Id/1/Todays_Update/ewewewe/Date/2016-05-23
	function insertUpdates_post()
    {
		$data = $this->DailyUpdate_model->InsertUpdates($this->post('Class_Id'),$this->post('Section_Id'),$this->post('Todays_Update'),$this->post('Date'));
        if($data)
        {
			$query = $this->db->query("SELECT GCM_RegId FROM ".TABLE_GCM." WHERE User_Type='Parent'");
			if($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					$this->gcm->addRecepient($row['GCM_RegId']);
				}
				$message = array("Notification" => "Assalamu’alaikum! Today's Update have been added in the app." ,"image_url" => "");	
				$this->gcm->setData($message);
				$Type='Parent';
				$this->gcm->send($Type);
			}
			
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr'] = $data;
			$ret_val ['responsemsg'] = "success";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "No records found in ".TABLE_UPDATES;
            $this->response($ret_val, 404);
        }
	}
	
	//http://localhost/UIISR/index.php/web_services/DailyUpdate_api/deleteUpdates/Update_Id/1
	function deleteUpdates_post()
    {
		$data = $this->DailyUpdate_model->deleteUpdate($this->post('Update_Id'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_UPDATES;
            $this->response($ret_val, 404);
        }
	}
}
?>