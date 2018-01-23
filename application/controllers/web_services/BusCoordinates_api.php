<?php
require(APPPATH.'/libraries/REST_Controller.php');

class BusCoordinates_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Coordinates_model');
		$this->load->database();
		$this->load->library('GCM');
	}
//	http://localhost/Tifly_Pro/index.php?web_services/BusCoordinates_api/getCoordinates/Stu_Id/1/Date/2016-10-25
	function getCoordinates_get()
    {
		if(!$this->get('Stu_Id')|| !$this->get('Date'))
        {
            $ret_val ['responsecode'] = 5;
			$ret_val ['responsemsg'] = "Empty Params";
            $this->response($ret_val, 400);
        }
		
		$data = $this->Coordinates_model->getCurrentCoordinates($this->get('Stu_Id'),$this->get('Date'));
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
	
	//http://localhost/Tifly_Pro/index.php?web_services/BusCoordinates_api/insertCoordinates/bus_id/1/driver_id/1/latitude/10.3564654/langitude/10.321321/cur_speed/40/distance/12/trip_type/1
	function insertCoordinates_get()
    {
		$data = $this->Coordinates_model->InsertData($this->get('bus_id'),
												$this->get('driver_id'),$this->get('latitude'),
												$this->get('langitude'),$this->get('cur_speed'),
												$this->get('distance'),$this->get('trip_type'));
        if($data)
        {
		
			//$school_location= $this->db->get_where('settings', array('type' => 'school_location'))->row()->description;	
			
			//$latlong1=$this->get('latitude').",".$this->get('langitude');
			
			
			//echo $this->distance($this->get('latitude'), $this->get('langitude'), $schoolLat, $schoolLang, "K");
			//echo $this->getDistance($latlong1,$school_location);
			
			
			$speed_limit= $this->db->get_where('settings', array('type' => 'speed_limit'))->row()->description;
			
			if($this->get('cur_speed')>$speed_limit){
				
				$bus_name= $this->db->get_where('bus_details', array('bus_id' => $this->get('bus_id')))->row()->name;
				$driver_name = $this->db->get_where('employee_details', array('emp_id' => $this->get('driver_id')))->row()->name;
				
				//insert in Driver merit system
				$data = array(
				'driver_id'=>$this->get('driver_id'),
				'driver_name'=>$driver_name,
				'parent_id'=>0,
				'review_date'=>date('Y-m-d'),
				'review_month'=>date('F'),
				'speed_limit'=>0.5,
				'rash_driving'=>0,
				'time_maitanance'=>0,
				'attendance'=>0,
				'feedback'=>0,
				'inserted_on'=>date('Y-m-d G:i:s')
				);

				$this->db->insert('driver_merit_system',$data);
			
				$this -> db -> select('GCM_RegId');
				$this -> db -> from('app_gcm_parents');
				$this -> db -> where('User_Type', 'transport');
				
				$query = $this->db->get();
				if($query->num_rows() > 0) {
					foreach ($query->result_array() as $row) {
						
						//$message = array("Notification" => "Assalamu’alaikum! your child is Absent today" ,"image_url" => "");	
						
						//$bus_name= $this->db->get_where('bus_details', array('bus_id' => $this->get('bus_id')))->row()->name;
						//$driver_name = $this->db->get_where('driver_details', array('driver_id' => $this->get('driver_id')))->row()->name;
			
						$res = array();
						
						$res['data']['title'] = "Speed Alert";
						$res['data']['message'] = $driver_name."\n".$bus_name."\n".date('Y-m-d G:i:s');
						$res['data']['notification_message'] = "This Bus is crossing the speed limit. Speed is".$this->get('cur_speed');
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
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Not able to insert";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Tifly_Pro/index.php?web_services/BusCoordinates_api/getAllBusCoordinates
	function getAllBusCoordinates_get()
    {
		$data = $this->Coordinates_model->getCurrentCoordinatesOfAllBuses();
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
	/*
//	http://localhost/Tifly_Pro/index.php?web_services/BusCoordinates_api/getBusRoute/Route_Id/1
	function getBusRoute_get()
    {
		if(!$this->get('Route_Id'))
        {
            $ret_val ['responsecode'] = 5;
			$ret_val ['responsemsg'] = "Empty Params";
            $this->response($ret_val, 400);
        }
		
		$data = $this->Coordinates_model->getBusRouteCoordinates($this->get('Route_Id'));
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
	}*/

	//http://localhost/Tifly_Pro/index.php?web_services/BusCoordinates_api/insertBusDisable/bus_id/1/status/1
	
	//1=>Enable 2=>Disable
	function insertBusDisable_get()
    {
		$data = $this->Coordinates_model->InsertBusDisable($this->get('bus_id'),$this->get('status'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "Inserted Successfully";
			$this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Not able to insert";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Tifly_Pro/index.php?web_services/BusCoordinates_api/getBusDisableStatus
	function getBusDisableStatus_get()
    {
		$data = $this->Coordinates_model->getBusRouteDisableStatus();
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
	
	//	http://localhost/Tifly_Pro/index.php?web_services/BusCoordinates_api/getCoordinatesByDate/From_Date/2017-01-04/To_Date/2017-01-05
	function getCoordinatesByDate_get()
    {
		$data = $this->Coordinates_model->getCoordinatesForSpeed($this->get('From_Date'),$this->get('To_Date'));
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
	
		//http://localhost/Tifly_Pro/index.php?web_services/BusCoordinates_api/recordBusBreakdown/bus_id/1/status/1
	
	//1=>Normal 2=>Breakdown
	function recordBusBreakdown_get()
    {
		$data = $this->Coordinates_model->recordBusStatus($this->get('bus_id'),$this->get('status'));
        if($data)
        {
			$this -> db -> select('GCM_RegId');
			$this -> db -> from('app_gcm_parents');
			$this -> db -> where('User_Type', 'transport');
				
			$query = $this->db->get();
			if($query->num_rows() > 0) {
				foreach ($query->result_array() as $row) {
					
					//$message = array("Notification" => "Assalamu’alaikum! your child is Absent today" ,"image_url" => "");	
					
					$bus_name= $this->db->get_where('bus_details', array('bus_id' => $this->get('bus_id')))->row()->name;
					
					$res = array();
					
					$res['data']['title'] = "Breakdown Alert";
					$res['data']['message'] = "Bus Name: ".$bus_name."\nDate: ".date('Y-m-d G:i:s');
					$res['data']['notification_message'] = "This Bus is Breakdown.";
					$res['data']['image'] = "";
					$res['data']['type'] = "breakdown~".$this->get('bus_id')."~".$bus_name;
					
					$this->gcm->addRecepient($row['GCM_RegId']);
					$this->gcm->setData($res);
					$Type='transport';
					$this->gcm->send($Type);
				}
			}
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "Inserted Successfully";
			$this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Not able to insert";
            $this->response($ret_val, 404);
        }
	}
	
	//http://localhost/Tifly_Pro/index.php?web_services/BusCoordinates_api/getBreakdownBuses/bus_id/1/from_date/2017-01-01/to_date/2017-02-19
	function getBreakdownBuses_get()
    {
		$data = $this->Coordinates_model->getBreakdownRecords($this->get('bus_id'),$this->get('from_date'),$this->get('to_date'));
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
	
	//http://localhost/Tifly_Pro/index.php?web_services/BusCoordinates_api/triggerNearAlert/bus_id/1/route_id/12/trip_type/1
	function triggerNearAlert_get()
    {
		$bus_id=$this->get('bus_id');
		$route_id=$this->get('route_id');
		$trip_type=$this->get('trip_type');
		
		if($trip_type==1){
			$query=$this->db->query("SELECT GCM_RegId FROM app_gcm_parents WHERE User_Type='parent' AND User_Id 
			IN (SELECT parent_id FROM student WHERE assigned_bus=".$bus_id." AND pickup_route_id=".$route_id.")");
		}else{
			$query=$this->db->query("SELECT GCM_RegId FROM app_gcm_parents WHERE User_Type='parent' AND User_Id 
			IN (SELECT parent_id FROM student WHERE assigned_bus=".$bus_id." AND drop_route_id=".$route_id.")");
		}
		if($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$message = array("Notification" => "trigger" ,"image_url" => "");	
				$this->gcm->addRecepient($row['GCM_RegId']);
				$this->gcm->setData($message);
				$Type='parent';
				$this->gcm->send($Type);
			}
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "success";
			$this->response($ret_val,200);
		}else{
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "No records found ";
            $this->response($ret_val, 404);
		}
		
		
	}
	function distance($lat1, $lon1, $lat2, $lon2, $unit) {
		
		$theta = $lon1 - $lon2;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;
		$unit = strtoupper($unit);

		if ($unit == "K") {
			return ($miles * 1.609344);
		} else if ($unit == "N") {
			return ($miles * 0.8684);
		} else {
			return $miles;
		}
	}
}
?>