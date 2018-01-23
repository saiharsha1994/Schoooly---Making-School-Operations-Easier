<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Chatting_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Chatting_model');
		$this->load->database();
		$this->load->library('GCM');
	}	
//	http://localhost/UIISR/index.php/web_services/Chatting_api/chatList/Message_Thread/emp1/current_user/emp1
	function chatList_get()
    {
		$data = $this->Chatting_model->getChatList($this->get('Message_Thread'),$this->get('current_user'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_CHAT;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/UIISR/index.php/web_services/Chatting_api/contactList/PostTo_Id/emp1
	function contactList_get()
    {
		$data = $this->Chatting_model->getContactList($this->get('PostTo_Id'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_CHAT;
            $this->response($ret_val, 404);
        }
	}
	
	
	//	http://localhost/UIISR/index.php/web_services/Chatting_api/changeReadStatus/mark_thread_messages_read/2165165/current_user/emp1
	function changeReadStatus_get()
    {
		$data = $this->Chatting_model->mark_thread_messages_read($this->get('mark_thread_messages_read'),$this->get('current_user'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_CHAT;
            $this->response($ret_val, 404);
        }
	}
	
	
	//	http://localhost/UIISR/index.php/web_services/Chatting_api/getUnreadCount/current_user/emp1
	function getUnreadCount_get()
    {
		$data = $this->Chatting_model->count_unread_message_of_thread($this->get('current_user'));
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
	//	http://localhost/UIISR/index.php/web_services/Chatting_api/clearChat/messages_thread/2165165/current_user/emp1
	function clearChat_get()
    {
		$data = $this->Chatting_model->clearChat($this->get('messages_thread'),$this->get('current_user'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
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
	//http://localhost/UIISR/index.php/web_services/Chatting_api/insert/sender/teacher-1/receiver/parent-1/message/hai/post_type/1/post_url/url
	function insert_get()
    {
		//send_new_message($sender,$receiver,$message,$post_type,$post_url)
		$data = $this->Chatting_model->send_new_message($this->get('sender'),$this->get('receiver'),$this->get('message'),$this->get('post_type'),$this->get('post_url'));
        if($data)
        {
			$receiver=$this->get('receiver');
			$myArray=array();
			$myArray = explode("-",$receiver);
			
			$Type=$myArray[0];
			$receiver_Id=$myArray[1];					
			
			$query = $this->db->query("SELECT GCM_RegId FROM ".TABLE_GCM." WHERE User_Type='".$Type."' AND User_Id=".$receiver_Id);
			if($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					$this->gcm->addRecepient($row['GCM_RegId']);
				}
				
				$message = array("Notification" => "Chat".$data."|".urldecode($this->get('sender')).":\n".urldecode($this->get('message')) ,"image_url" => "");	
				$this->gcm->setData($message);
				$this->gcm->send($Type);
			}
			$ret_val ['responsecode'] = 1;
			$ret_val ['data'] = $data;
			$ret_val ['responsemsg'] = "Inserted Successfully";
			$this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Not able to insert in ".TABLE_MESSAGE;
            $this->response($ret_val, 404);
        }
	}
	
	
	//http://localhost/Schoooly/index.php?web_services/Chatting_api/insertBroadcast/sender/teacher-1/message/hai/class_id/1/section_id
	function insertBroadcast_post()
    {
		$data = $this->Chatting_model->send_new_broadcast_message($this->post('sender'),$this->post('message'),$this->post('class_id'),$this->post('section_id'));
     
		if($data)
        {
			$running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
			
			$query = $this->db->query("SELECT GCM_RegId FROM ".TABLE_GCM." WHERE User_Type='parent' AND User_Id IN 
				(SELECT parent_id FROM student WHERE student_id IN 
				(SELECT student_id FROM enroll WHERE class_id=".$this->post('class_id')." AND section_id=".$this->post('section_id')." AND year='".$running_year."'))");
			if($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					$this->gcm->addRecepient($row['GCM_RegId']);
				}
				
				$message = array("Notification" => "Chat".$data."|".urldecode($this->post('sender')).":\n".urldecode($this->post('message')) ,"image_url" => "");	
				$this->gcm->setData($message);
				$this->gcm->send('parent');
			}
			$ret_val ['responsecode'] = 1;
			$ret_val ['data'] = $data;
			$ret_val ['responsemsg'] = "Inserted Successfully";
			$this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Not able to insert in ".TABLE_MESSAGE;
            $this->response($ret_val, 404);
        }
	}
	
}
?>