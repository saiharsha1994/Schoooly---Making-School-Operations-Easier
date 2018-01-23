<?php
require(APPPATH.'/libraries/REST_Controller.php');

class SendMessageFromDriver_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Notification_model');
		$this->load->database();
		$this->load->library('GCM');
	}	
	
//	http://localhost/Hikmah/index.php/web_services/SendMessageFromDriver_api/insert/Msg/info/MsgTo/1/Type/student
	function insert_post()
    {
		if($this->post('MsgTo')=='all'){
			$Type_arr = explode('-', urldecode($this->post('Type')));
			$Route_Id=$Type_arr[1];
			$Type=$Type_arr[0];
			
			$user_id="";
			if($Type=='parent'){
				$this -> db -> select('parent_id');
				$this -> db -> from('student');
				$this -> db -> where('pickup_route_id', $Route_Id);
				$this -> db -> or_where('drop_route_id', $Route_Id);
				$query1 = $this->db->get();
				$user_id= $query1->row('parent_id');
			}else{
				$this -> db -> select('emp_id');
				$this -> db -> from('employee_details');
				$this -> db -> where('pickup_route_id', $Route_Id);
				$this -> db -> or_where('drop_route_id', $Route_Id);
				$query1 = $this->db->get();
				$user_id= $query1->row('emp_id');
			}
			
			$this -> db -> select('*');
			$this -> db -> from(TABLE_GCM);	
			$this -> db -> where('User_Id',$user_id);
			$this -> db -> where('User_Type',$Type);
			
			$query = $this -> db -> get();
			if($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					$this->gcm->addRecepient($row['GCM_RegId']);
				}
				$message = array("Notification" => urldecode($this->post('Msg')) ,"image_url" => "");	
				$this->gcm->setData($message);
				
				$this->gcm->send($Type);
			}
		}else{
			$To_arr = explode(',', urldecode($this->post('MsgTo')));
			$Type_arr = explode(',', urldecode($this->post('Type')));
			
			for ($i = 0; $i < count($To_arr); $i++){
				$user_id="";
				if($Type_arr[$i]=='parent'){
					$this -> db -> select('parent_id');
					$this -> db -> from('student');
					$this -> db -> where('student_id', $To_arr[$i]);
					$query1 = $this->db->get();
					$user_id= $query1->row('parent_id');
				}else{
					$user_id=$To_arr[$i];
				}
				
				$this -> db -> select('*');
				$this -> db -> from(TABLE_GCM);	
				$this -> db -> where('User_Id',$user_id);
				$this -> db -> where('User_Type',$Type_arr[$i]);
				
				$query = $this -> db -> get();
				if($query->num_rows() > 0) {
					foreach ($query->result_array() as $row) {
						$this->gcm->addRecepient($row['GCM_RegId']);
					}
					$message = array("Notification" => urldecode($this->post('Msg')) ,"image_url" => "");	
					$this->gcm->setData($message);
					
					$this->gcm->send($Type_arr[$i]);
				}
			}
		}
		$ret_val ['responsecode'] = 1;
		$ret_val ['responsemsg'] = "Sent Successfully";
		$this->response($ret_val,200);
    }
}
?>