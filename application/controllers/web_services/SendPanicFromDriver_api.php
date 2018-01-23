<?php
require(APPPATH.'/libraries/REST_Controller.php');

class SendPanicFromDriver_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Notification_model');
		$this->load->database();
		$this->load->library('GCM');
	}	
	
//	http://localhost/Hikmah/index.php/web_services/SendPanicFromDriver_api/insert/MsgTo/1/BusID/1/DriverId/1
//MsgTo=1==>Parent 2==>Teacher 3==>TransportAdmin
	function insert_get()
    {
		$query ="";
		if($this->get('MsgTo')==1){
			$query = $this->db->query("SELECT GCM_RegId FROM ".TABLE_GCM." WHERE User_Type='parent'");
		}else if($this->get('MsgTo')==2){
			$query = $this->db->query("SELECT GCM_RegId FROM ".TABLE_GCM." WHERE User_Type='teacher'");
		}else if($this->get('MsgTo')==3){
			$query = $this->db->query("SELECT GCM_RegId FROM ".TABLE_GCM." WHERE User_Type='transport'");
		}
		
		$bus_name= $this->db->get_where('bus_details', array('bus_id' => $this->get('BusID')))->row()->name;
		$driver_name = $this->db->get_where('employee_details', array('emp_id' => $this->get('DriverId')))->row()->name;
			
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				if($this->get('MsgTo')==1){
					$this->gcm->addRecepient($row['GCM_RegId']);
					$message = array("Notification" => "Its a Panic Alert From ".$bus_name." And the Driver is ".$driver_name ,"image_url" => "");	
					$this->gcm->setData($message);
					$Type='parent';
					$this->gcm->send($Type);
				}else if($this->get('MsgTo')==2){
					$this->gcm->addRecepient($row['GCM_RegId']);
					$message = array("Notification" => "Its a Panic Alert From ".$bus_name." And the Driver is ".$driver_name ,"image_url" => "");	
					$this->gcm->setData($message);
					$Type='teacher';
					$this->gcm->send($Type);
				}else if($this->get('MsgTo')==3){
					$res = array();
					$res['data']['title'] = "Panic Alert";
					$res['data']['message'] = $driver_name."\n".$bus_name."\n".date('Y-m-d G:i:s');
					$res['data']['notification_message'] = "Its a Panic Alert From, Please contact the driver immediately";
					$res['data']['image'] = "";
					$res['data']['type'] = "normal";
					
					$this->gcm->addRecepient($row['GCM_RegId']);
					$this->gcm->setData($res);
					$Type='transport';
					$this->gcm->send($Type);
				}
			}
		}
		$ret_val ['responsecode'] = 1;
		$ret_val ['responsemsg'] = "Inserted Successfully";
		$this->response($ret_val,200);
    }
}
?>