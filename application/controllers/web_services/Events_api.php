<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Events_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Event_model');
		$this->load->database();
		$this->load->library('GCM');
	}	
//	http://localhost/Hikmah/index.php/web_services/Events_api/event
	function event_get()
    {
		$data = $this->Event_model->getEvents();
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_EVENT;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Hikmah/index.php/web_services/Events_api/insert/Event_Title/Test Title/Event_Info/info/Event_Date/2016-3-1
	function insert_post()
    {
		$data = $this->Event_model->InsertData($this->post('Event_Title'),$this->post('Event_Info'),$this->post('Event_Date'));
        if($data)
        {
			$query = $this->db->query("SELECT GCM_RegId FROM ".TABLE_GCM." WHERE User_Type='parent'");
			if($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					$this->gcm->addRecepient($row['GCM_RegId']);
				}
				$message = array("Notification" => "Assalamu’alaikum! New Event have been added in the app." ,"image_url" => "");	
				$this->gcm->setData($message);
				$Type='parent';
				$this->gcm->send($Type);
			}
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "Inserted Successfully";
			$this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Not able to insert in ".TABLE_EVENT;
            $this->response($ret_val, 404);
        }
	}
	
	//http://localhost/Hikmah/index.php/web_services/Events_api/eventDelete/Event_Id/1
	function eventDelete_post()
    {
		$data = $this->Event_model->deleteEvent($this->post('Event_Id'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "Deleted Successfully";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Not able to delete in ".TABLE_EVENT;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Hikmah/index.php/web_services/Events_api/vacations_breaks
	function vacations_breaks_get()
    {
		$data = $this->Event_model->getVacationsAndBreaks();
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_EVENT;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Hikmah/index.php/web_services/Events_api/exam_dates
	function exam_dates_get()
    {
		$data = $this->Event_model->getExamDates();
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_EVENT;
            $this->response($ret_val, 404);
        }
	}
}
?>