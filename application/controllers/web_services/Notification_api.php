<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Notification_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Notification_model');
		$this->load->database();
		$this->load->library('GCM');
	}	
	
//	http://localhost/Hikmah/index.php/web_services/Notification_api/notifications/
	function notifications_get()
    {
		$data = $this->Notification_model->getNotificationData();
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_NOTICE;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Hikmah/index.php/web_services/Notification_api/noticeboard/Type/parent
	function noticeboard_get()
    {
		$data = $this->Notification_model->getNoticeBoardData($this->get('Type'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_NOTICEBOARD;
            $this->response($ret_val, 404);
        }
	}
	 
	//	http://localhost/Hikmah/index.php/web_services/Notification_api/insert/Notice_Title/Test Title/Notice_Info/info/Notice_Date/2016-3-1/Notice_Img/url
	function insert_post()
    {
																//$Notice_Title,$Notice_Info,$Notice_Date,$Notice_Img)
		$data = $this->Notification_model->InsertData($this->post('Notice_Title'),$this->post('Notice_Info'),$this->post('Notice_Date'),$this->post('Notice_Img'));
        if($data)
        {
			$query = $this->db->query("SELECT GCM_RegId FROM ".TABLE_GCM." WHERE User_Type='parent'");
			if($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					$this->gcm->addRecepient($row['GCM_RegId']);
				}
				$message = array("Notification" => "Assalamu’alaikum! new notice have been added in the app." ,"image_url" => "");	
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
			$ret_val ['responsemsg'] = "Not able to insert in ".TABLE_NOTICE;
            $this->response($ret_val, 404);
        }
	}
	
	//http://localhost/Hikmah/index.php/web_services/Notification_api/noticeDelete/Notice_Id/1
	function noticeDelete_post()
    {
		$data = $this->Notification_model->DeleteNoticeData($this->post('Notice_Id'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "Deleted Successfully";
            $this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Not able to delete in ".TABLE_NOTICE;
            $this->response($ret_val, 404);
        }
	}
	
	//http://localhost/Schoooly/index.php?web_services/Notification_api/getAlertList/user_id/1
	function getAlertList_get()
    {
		$data = $this->Notification_model->getAlertList($this->get('user_id'));
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
	
	//http://localhost/Schoooly/index.php?web_services/Notification_api/changeAlertStatus/alert_id/1
	function changeAlertStatus_post()
    {
		$data = $this->Notification_model->changeAlertStatus($this->post('alert_id'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
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
}
?>