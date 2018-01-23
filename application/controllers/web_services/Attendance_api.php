<?php
require(APPPATH.'/libraries/REST_Controller.php');

class Attendance_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Attendance_model');
		$this->load->database();
		$this->load->library('GCM');
		$this->load->library('SendEmail');
	}
//	http://localhost/Hikmah/index.php/web_services/Attendance_api/dailyReport/Stu_Id/1/Date/2016-03-01
	function dailyReport_get()
    {
		if(!$this->get('Stu_Id')|| !$this->get('Date'))
        {
            $ret_val ['responsecode'] = 5;
			$ret_val ['responsemsg'] = "Empty Params";
            $this->response($ret_val, 400);
        }
		
		$data = $this->Attendance_model->getTodaysReport($this->get('Stu_Id'),$this->get('Date'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_ATTENDANCE;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Hikmah/index.php/web_services/Attendance_api/monthlyReport/Stu_Id/1/Att_Month/March
	function monthlyReport_get()
    {
		if(!$this->get('Stu_Id')|| !$this->get('Att_Month'))
        {
            $ret_val ['responsecode'] = 5;
			$ret_val ['responsemsg'] = "Empty Params";
            $this->response($ret_val, 400);
        }
		
		$data = $this->Attendance_model->getMonthlyReport($this->get('Stu_Id'),$this->get('Att_Month'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_ATTENDANCE;
            $this->response($ret_val, 404);
        }
	}
	
	//http://localhost/Hikmah/index.php/web_services/Attendance_api/insertAttendance/Att_Date/2015-3-12/Att_Month/March/Class_Id/1/Section_Id/1/Stu_Id/1/Stu_Name/Thouseef/In_Status/1/Out_Status/1
	function insertAttendance_post()
    {
		$data = $this->Attendance_model->InsertData($this->post('Att_Date'),$this->post('Att_Month'),
												$this->post('Class_Id'),$this->post('Section_Id'),
												$this->post('Stu_Id'),$this->post('Stu_Name'),
												$this->post('In_Status'),$this->post('Out_Status'));
        if($data)
        {
			$cur_Date = date("Y-m-d");
			//send attendance notification to parents
			$Attquery=$this->db->query("SELECT G.GCM_RegId,A.In_Status,A.Out_Status,A.student_name FROM ".TABLE_GCM." G INNER JOIN ".TABLE_STUDENTS." S ON
			G.User_Id=S.parent_id INNER JOIN ".TABLE_ATTENDANCE." A ON
			S.student_id=A.student_id WHERE G.User_Id IN (SELECT S.parent_id FROM ".TABLE_STUDENTS." WHERE S.student_id 
			IN (SELECT A.student_id FROM ".TABLE_ATTENDANCE." WHERE A.att_date= '".$cur_Date."')) AND G.User_Type='parent'");
			
			if($Attquery->num_rows() > 0) {
				foreach ($Attquery->result_array() as $row) {
					$InStatus=$row['In_Status'];
					$OutStatus=$row['Out_Status'];
					$Stu_Name=$row['student_name'];
					if($InStatus==1 && $OutStatus==2)
					{
						$message = array("Notification" => "Alhumdulillah! ".$Stu_Name." has entered the class." ,"image_url" => "");	
					}else if($InStatus==1 && $OutStatus==1){
						$message = array("Notification" => "Such a lovely child! ".$Stu_Name." has left the class." ,"image_url" => "");	
					}
					else if($InStatus==2){
						$message = array("Notification" => "Assalamu’alaikum! your child is Absent today" ,"image_url" => "");	
					}
					$this->gcm->clearRecepients();
					$this->gcm->addRecepient($row['GCM_RegId']);
					$this->gcm->setData($message);
					$Type='parent';
					$this->gcm->send($Type);
				}
			}
			
			//Send alert if bus attendance is present and class attendance absent
			//only pick up trip is enough
			// msg to parent
			$Attquery1=$this->db->query("SELECT G.GCM_RegId,A.in_status,A.out_status,A.student_name,A.student_id,S.pickup_route_id FROM app_gcm_parents G 
				INNER JOIN student S ON G.User_Id=S.parent_id 
				INNER JOIN attendance_driver A ON S.student_id=A.student_id AND A.user_type='student' 
				WHERE G.User_Id IN (SELECT S.parent_id FROM student WHERE S.student_id 
				IN (SELECT A.student_id FROM attendance_driver WHERE A.att_date= '".$cur_Date."')) 
				AND G.User_Type='parent' AND A.trip_type=1");
			
			if($Attquery1->num_rows() > 0) {
				foreach ($Attquery1->result_array() as $row1) {
					$BusInStatus=$row1['in_status'];
					$BusOutStatus=$row1['out_status'];
					$Stu_Name=$row1['student_name'];
					
					$this->db->select('driver_id,bus_id');
					$this-> db -> from('routes');
					$this-> db ->where('route_id', $row1['pickup_route_id']);	
					$RouteData=$this -> db -> get();
					
					$driver_id=$RouteData->row('driver_id');	
					$bus_id=$RouteData->row('bus_id');
					
					$driver_mobile=$this->db->get_where('employee_details', array('emp_id' => $driver_id))->row()->mobile;
					$bus_number=$this->db->get_where('bus_details', array('bus_Id' => $bus_id))->row()->plate_number;
        
					$this->db->select('In_Status,Out_Status');
					$this-> db -> from('attendance');
					$this-> db ->where('student_id', $row1['student_id']);	
					$this-> db ->where('att_date', $cur_Date);	
					
					$attData=$this -> db -> get();
					
					$InStatus=$attData->row('In_Status');	
					$OutStatus=$attData->row('Out_Status');
					if($BusInStatus==1 && $InStatus==2){
						$message = array("Notification" => "Emergency Alert!\n".$Stu_Name." has not entered the class yet. Please contact driver immediately\nDriver Mobile : ".$driver_mobile."\nBus Number : ".$bus_number ,"image_url" => "");	
						
						$this->gcm->clearRecepients();
						$this->gcm->addRecepient($row1['GCM_RegId']);
						$this->gcm->setData($message);
						$Type='parent';
						$this->gcm->send($Type);
					}
					
					
				}
			}
			// msg to Transport
			$Attquery2=$this->db->query("SELECT A.In_Status,A.Out_Status,A.student_name,A.student_id,S.pickup_route_id,S.class_name,S.section_name FROM attendance_driver A 
				INNER JOIN student S ON A.student_id=S.student_id AND A.user_type='student' 
				AND A.att_date='".$cur_Date."'");
			
			if($Attquery2->num_rows() > 0) {
				foreach ($Attquery2->result_array() as $row2) {
					$BusInStatus=$row2['In_Status'];
					$BusOutStatus=$row2['Out_Status'];
					$Stu_Name=$row2['student_name'];
					$class=$row2['class_name'];
					$section=$row2['section_name'];
					
					$this->db->select('driver_id,bus_id');
					$this-> db -> from('routes');
					$this-> db ->where('route_id', $row2['pickup_route_id']);	
					$RouteData=$this -> db -> get();
					
					$driver_id=$RouteData->row('driver_id');	
					$bus_id=$RouteData->row('bus_id');
					
					$driver_mobile=$this->db->get_where('employee_details', array('emp_id' => $driver_id))->row()->mobile;
					$driver_name=$this->db->get_where('employee_details', array('emp_id' => $driver_id))->row()->name;
					$bus_number=$this->db->get_where('bus_details', array('bus_Id' => $bus_id))->row()->plate_number;
        
					
					$this->db->select('in_status,out_status');
					$this-> db -> from('attendance');
					$this-> db ->where('student_id', $row2['student_id']);	
					$this-> db ->where('att_date', $cur_Date);	
					
					$attData=$this -> db -> get();
					
					$InStatus=$attData->row('in_status');	
					$OutStatus=$attData->row('out_status');
					
					$this -> db -> select('GCM_RegId');
					$this -> db -> from('app_gcm_parents');
					$this -> db -> where('User_Type', 'transport');
					$query = $this->db->get();
					if($query->num_rows() > 0) {
						foreach ($query->result_array() as $row3) {
							$res = array();
					
							if($BusInStatus==1 && $InStatus==2){
								$res['data']['title'] = "Emergency Alert!";
								$res['data']['message'] = "Student ".$Stu_Name." of has not entered class ".$class." ".$section." \nPlease contact Driver : ".$driver_name." \nMobile : ".$driver_mobile."\nBus number : ".$bus_number."\n".date('Y-m-d G:i:s');
								$res['data']['notification_message'] ="";
								$res['data']['image'] = "";
								$res['data']['type'] = "normal";
								$this->gcm->clearRecepients();
								$this->gcm->addRecepient($row3['GCM_RegId']);
								$this->gcm->setData($res);
								$Type='transport';
								$this->gcm->send($Type);
							}
							
						}
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
			$ret_val ['responsemsg'] = "Not able to insert in ".TABLE_ATTENDANCE;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Hikmah/index.php/web_services/Attendance_api/TodaysReport/Class_Id/1/Section_Id/1/Date/2016-03-01
	function TodaysReport_get()
    {
		if(!$this->get('Class_Id')|| !$this->get('Date'))
        {
            $ret_val ['responsecode'] = 5;
			$ret_val ['responsemsg'] = "Empty Params";
            $this->response($ret_val, 400);
        }
		
		$data = $this->Attendance_model->getTodaysReportForTeacher($this->get('Class_Id'),$this->get('Section_Id'),$this->get('Date'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_ATTENDANCE;
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Hikmah/index.php/web_services/Attendance_api/TodaysReportForDriver/Driver_Id/1/Bus_Id/1/Date/2016-03-01
	function TodaysReportForDriver_get()
    {
		if(!$this->get('Driver_Id')|| !$this->get('Date'))
        {
            $ret_val ['responsecode'] = 5;
			$ret_val ['responsemsg'] = "Empty Params";
            $this->response($ret_val, 400);
        }
		
		$data = $this->Attendance_model->getTodaysReportForDriver($this->get('Driver_Id'),$this->get('Bus_Id'),$this->get('Date'));
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
			$ret_val ['responsemsg'] = "No records found in ".TABLE_ATTENDANCE;
            $this->response($ret_val, 404);
        }
	}
	
	
	//http://localhost/Hikmah/index.php/web_services/Attendance_api/insertAttendanceDriver/Att_Date/2015-3-12/Att_Month/March/driver_id/1/bus_id/1/trip_type/1/Stu_id/1/Stu_Name/Thouseef/In_Status/1/Out_Status/1/user_type/student
	function insertAttendanceDriver_get()
    {
		$data = $this->Attendance_model->InsertDataForDriver($this->get('Att_Date'),$this->get('Att_Month'),
												$this->get('driver_id'),$this->get('bus_id'),$this->get('trip_type'),
												$this->get('Stu_id'),$this->get('Stu_Name'),
												$this->get('In_Status'),$this->get('Out_Status'),
												$this->get('user_type'));
        if($data)
        {
			/*$cur_Date = date("Y-m-d");
			if($this->get('user_type')=='student'){
				
				$Attquery=$this->db->query("SELECT G.GCM_RegId,A.In_Status,A.Out_Status,A.student_name FROM ".TABLE_GCM." G INNER JOIN ".TABLE_STUDENTS." S ON
				G.User_Id=S.parent_id INNER JOIN attendance_driver A ON
				S.student_id=A.student_id WHERE G.User_Id IN (SELECT S.parent_id FROM ".TABLE_STUDENTS." WHERE S.student_id 
				IN (SELECT A.student_id FROM attendance_driver WHERE A.att_date= '".$cur_Date."'  AND A.student_id='".$this->get('Stu_id')."' AND A.trip_type='".$this->get('trip_type')."')) AND G.User_Type='parent'");
				
				if($Attquery->num_rows() > 0) {
					foreach ($Attquery->result_array() as $row) {
						$InStatus=$row['In_Status'];
						$OutStatus=$row['Out_Status'];
						$Stu_Name=$row['student_name'];
						if($this->get('trip_type')==1){
							
							if($InStatus==1 && $OutStatus==2)
							{
								$message = array("Notification" => $Stu_Name." has boarded the bus and is on his way to school." ,"image_url" => "");	
							}else if($InStatus==1 && $OutStatus==1){
								$message = array("Notification" => "Bus has reached School. ".$Stu_Name." has disembarked and headed to class." ,"image_url" => "");	
							}
							else if($InStatus==2){
								$message = array("Notification" => "Assalamu’alaikum! your child is Absent today" ,"image_url" => "");	
							}
							$this->gcm->addRecepient($row['GCM_RegId']);
							$this->gcm->setData($message);
							$Type='parent';
							$this->gcm->send($Type);
						}else if($this->get('trip_type')==2){
							
							if($InStatus==1 && $OutStatus==2)
							{
								$message = array("Notification" => $Stu_Name."  is in the school bus now and will start shortly on the trip back home." ,"image_url" => "");	
							}else if($InStatus==1 && $OutStatus==1){
								$message = array("Notification" => "Bus has reached home. ".$Stu_Name." has disembarked and headed to home." ,"image_url" => "");	
							}
							else if($InStatus==2){
								$message = array("Notification" => "Assalamu’alaikum! your child is Absent today" ,"image_url" => "");	
							}
							$this->gcm->addRecepient($row['GCM_RegId']);
							$this->gcm->setData($message);
							$Type='parent';
							$this->gcm->send($Type);
						}					
					}
				}
			}*/
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "Inserted Successfully";
			$this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "Not able to insert ";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Hikmah/index.php/web_services/Attendance_api/dailyReportByBus/Route_Id/1/Date/2016-03-01/trip_type/1
	function dailyReportByBus_get()
    {
		if(!$this->get('Route_Id')|| !$this->get('Date'))
        {
            $ret_val ['responsecode'] = 5;
			$ret_val ['responsemsg'] = "Empty Params";
            $this->response($ret_val, 400);
        }
		
		$data = $this->Attendance_model->getReportByBus($this->get('Route_Id'),$this->get('Date'),$this->get('trip_type'));
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
	
	
	//	http://localhost/Hikmah/index.php/web_services/Attendance_api/driverDailyAttendance/Stu_Id/1/Date/2016-03-01/trip_type/1
	function driverDailyAttendance_get()
    {
		if(!$this->get('Stu_Id')|| !$this->get('Date'))
        {
            $ret_val ['responsecode'] = 5;
			$ret_val ['responsemsg'] = "Empty Params";
            $this->response($ret_val, 400);
        }
		
		$data = $this->Attendance_model->getTodaysBusAttendance($this->get('Stu_Id'),$this->get('Date'),$this->get('trip_type'));
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
	
	//	http://localhost/Hikmah/index.php/web_services/Attendance_api/busAttendanceReport/Stu_Id/1/Start_date/2016-11-1/End_date/2016-11-5
	function busAttendanceReport_get()
    {
		if(!$this->get('Stu_Id'))
        {
            $ret_val ['responsecode'] = 5;
			$ret_val ['responsemsg'] = "Empty Params";
            $this->response($ret_val, 400);
        }
		
		$data = $this->Attendance_model->getBusAttendanceReport($this->get('Stu_Id'),$this->get('Start_date'),$this->get('End_date'));
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

	//http://localhost/Schoooly/index.php/web_services/Attendance_api/misbehavior_insert/date/2015-3-12/bus_id/1/student_id/1/name/thouseef/details/misbehaving
	function misbehavior_insert_post()
    {
		
		$details=array(
				'date' => urldecode($this->post('date')),
				'bus_id' => urldecode($this->post('bus_id')),
				'student_id' => urldecode($this->post('student_id')),
				'details' => urldecode($this->post('details'))
				);
							
		$data = $this->Attendance_model->InsertMisbehavior($details);
        if($data)
        {
			$Attquery=$this->db->query("SELECT G.GCM_RegId FROM ".TABLE_GCM." G INNER JOIN ".TABLE_STUDENTS." S ON
			G.User_Id=S.parent_id WHERE G.User_Id IN (SELECT S.parent_id FROM ".TABLE_STUDENTS." 
			WHERE S.student_id=".$this->get('student_id').") AND G.User_Type='parent'");
			
			if($Attquery->num_rows() > 0) {
				foreach ($Attquery->result_array() as $row) {
					
					$message = array("Notification" => "Assalamu’alaikum! your child ".$this->post('name')." is misbehaving in bus." ,"image_url" => "");	
					
					$this->gcm->addRecepient($row['GCM_RegId']);
					$this->gcm->setData($message);
					$Type='parent';
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
			$ret_val ['responsemsg'] = "Not able to insert ";
            $this->response($ret_val, 404);
        }
	}

	//	http://localhost/Schoooly/index.php/web_services/Attendace_api/MisbehaveByBus/bus_id/1
	function MisbehaveByBus_get()
    {
		$data = $this->Attendance_model->getMisbehaveByBus($this->get('bus_id'));
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
	
	//	http://localhost/Schoooly/index.php/web_services/Attendance_api/addLeaveRequest/student_id/1/from_date/2017-01-01/to_date/2017-01-01/no_of_days/1/reason/fever/user_type/0
	function addLeaveRequest_post()
    {
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$Year= $query->row('description');
		
		$cur_Date = date("Y-m-d");
		$details=array(
				'student_id' => urldecode($this->post('student_id')),
				'from_date' => urldecode($this->post('from_date')),
				'to_date' => urldecode($this->post('to_date')),
				'no_of_days' => urldecode($this->post('no_of_days')),
				'user_type' => urldecode($this->post('user_type')),
				'status' => '1',
				'applied_on' => $cur_Date,
				'year' => $Year,
				'reason' => urldecode($this->post('reason'))
				);
							
		$data = $this->Attendance_model->addLeaveDetails($details);
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
	
	//	http://localhost/Schoooly/index.php/web_services/Attendance_api/addLeaveRequestForAdmin/student_id/1/from_date/2017-01-01/to_date/2017-01-01/no_of_days/1/reason/fever
	function addLeaveRequestForAdmin_post()
    {
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$Year= $query->row('description');
		
		$cur_Date = date("Y-m-d");
		//user_type= 3=>Transport Admin / 4=>Drivers
		$details=array(
				'student_id' => urldecode($this->post('user_id')),
				'user_type' => urldecode($this->post('user_type')),
				'from_date' => urldecode($this->post('from_date')),
				'to_date' => urldecode($this->post('to_date')),
				'no_of_days' => urldecode($this->post('no_of_days')),
				'status' => '1',
				'applied_on' => $cur_Date,
				'year' => $Year,
				'reason' => urldecode($this->post('reason'))
				);
							
		$data = $this->Attendance_model->addLeaveDetails($details);
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
	
	//	http://localhost/Schoooly/index.php/web_services/Attendace_api/LeaveListOfAdmins/from_date/2017-05-01/to_date/2017-05-05/user_type/3/user_id/1
	function LeaveListOfAdmins_get()
    {
		$data = $this->Attendance_model->getLeaveDetailsForTransportAdmin($this->get('user_type'),$this->get('user_id'),$this->get('from_date'),$this->get('to_date'));
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
	
	//	http://localhost/Schoooly/index.php/web_services/Attendace_api/editLeaveRequest/leave_id/1/status/2/reason/aas
	function editLeaveRequest_post()
    {
		$data = $this->Attendance_model->editLeaveDetails($this->post('leave_id'),$this->post('status'),urldecode($this->post('reason')));
        if($data)
        {
			//send Notifications & Email
			
			$user_type=$this->db->get_where('leave_records', array('id' => $this->post('leave_id')))->row()->user_type;				
			$user_id=$this->db->get_where('leave_records', array('id' => $this->post('leave_id')))->row()->student_id;				
			//send Notification to parent
			if($user_type==0){
				$Attquery=$this->db->query("SELECT G.GCM_RegId,S.name,G.Email FROM app_gcm_parents G INNER JOIN student S ON
						G.User_Id=S.parent_id WHERE G.User_Id IN 
						(SELECT S.parent_id FROM student WHERE S.student_id =".$user_id.") 
						AND G.User_Type='parent'");
				
				if($Attquery->num_rows() > 0) {
					foreach ($Attquery->result_array() as $row) {
						$message="";
						if($this->post('status')=='2'){
							$message = array("Notification" => "Hi, Your child ".$row['name'].", leave is approved." ,"image_url" => "");	
						}else if($this->post('status')=='3'){
							$message = array("Notification" => "Hi, Your child ".$row['name'].", leave is rejected. And the reason is ".urldecode($this->post('reason')) ,"image_url" => "");	
						}
						$this->gcm->addRecepient($row['GCM_RegId']);
						$this->gcm->setData($message);
						$Type='parent';
						$this->gcm->send($Type);
						
						//Send Email for the same
						$Subject = 'Leave Response';
						$MailMessage="";
						if($this->post('status')=='2'){
							$MailMessage = "Dear Parent,"." &nbsp;Your child ".$row['name'].", leave is approved.";
						}else if($this->post('status')=='3'){
							$MailMessage = "Dear Parent,"." &nbsp;Your child ".$row['name'].", leave is rejected. And the reason is ".urldecode($this->post('reason'));
						}
											
						//$data = array('Emp_Contact_Mail'=>$this->input->post('ToEmail'));
						$this->sendemail->mailTo($Subject,$MailMessage,$row['Email']);
						
						//send alert to portal
						$parent_id=$this->db->get_where('student', array('student_id' => $user_id))->row()->parent_id;				
						$alertData=array('user_type'=>1,
								'alert_to'=>$parent_id,
								'alert_about'=>7,
								'alert_msg'=>$MailMessage,
								'alert_sent'=>4);
						$this->db->insert("notify_alert", $alertData);
					}
				}
			}
			//send Notification to teacher
			$teacher_role= $this->db->get_where('hr_roles', array(strtoupper('role') => 'TEACHER'))->row()->id;
			if($user_type==$teacher_role){
				$Attquery=$this->db->query("SELECT GCM_RegId,Name,Email FROM app_gcm_parents WHERE 
						User_Id=".$user_id." AND User_Type='teacher'");
				
				if($Attquery->num_rows() > 0) {
					foreach ($Attquery->result_array() as $row) {
						$message="";
						if($this->post('status')=='2'){
							$message = array("Notification" => "Hi ".$row['Name'].", Your leave is approved." ,"image_url" => "");	
						}else if($this->post('status')=='3'){
							$message = array("Notification" => "Hi".$row['Name'].", Your leave is rejected. And the reason is ".urldecode($this->post('reason')) ,"image_url" => "");	
						}
						$this->gcm->addRecepient($row['GCM_RegId']);
						$this->gcm->setData($message);
						$Type='teacher';
						$this->gcm->send($Type);
						
						//Send Email for the same
						$Subject = 'Leave Response';
						$MailMessage="";
						if($this->post('status')=='2'){
							$MailMessage = "Dear ".$row['Name'].","."&nbsp;Your leave is approved.";
						}else if($this->post('status')=='3'){
							$MailMessage = "Dear ".$row['Name'].","."&nbsp;Your leave is rejected. And the reason is ".urldecode($this->post('reason'));
						}
											
						//$data = array('Emp_Contact_Mail'=>$this->input->post('ToEmail'));
						$this->sendemail->mailTo($Subject,$MailMessage,$row['Email']);
						
						//send alert to portal
						
						$alertData=array('user_type'=>2,
								'alert_to'=>$user_id,
								'alert_about'=>7,
								'alert_msg'=>$MailMessage,
								'alert_sent'=>4);
						$this->db->insert("notify_alert", $alertData);
					}
				}
			}
			//send Notification to transport Admin
			$transport_role= $this->db->get_where('hr_roles', array(strtoupper('role') => 'TRANSPORT ADMIN'))->row()->id;
			if($user_type==$transport_role){
				$Attquery=$this->db->query("SELECT GCM_RegId,Name,Email FROM app_gcm_parents WHERE 
						User_Id=".$user_id." AND User_Type='transport'");
				
				if($Attquery->num_rows() > 0) {
					foreach ($Attquery->result_array() as $row) {
						$res = array();
						$res['data']['title'] = "Leave Response";
						$res['data']['message'] = date('Y-m-d G:i:s');
						if($this->post('status')=='2'){
							$res['data']['notification_message'] = "Hi ".$row['Name'].", Your leave is approved.";
						}else if($this->post('status')=='3'){
							$res['data']['notification_message'] = "Hi ".$row['Name'].", Your leave is rejected. And the reason is ".urldecode($this->post('reason'));
						}
						$res['data']['image'] = "";
						$res['data']['type'] = "normal";
						
						$this->gcm->addRecepient($row['GCM_RegId']);
						$this->gcm->setData($res);
						$Type='transport';
						$this->gcm->send($Type);
						
						//Send Email for the same
						$Subject = 'Leave Response';
						$MailMessage="";
						if($this->post('status')=='2'){
							$MailMessage = "Dear ".$row['Name'].","." &nbsp;Your leave is approved.";
						}else if($this->post('status')=='3'){
							$MailMessage = "Dear ".$row['Name'].","." &nbsp;Your leave is rejected. And the reason is ".urldecode($this->post('reason'));
						}
											
						//$data = array('Emp_Contact_Mail'=>$this->input->post('ToEmail'));
						$this->sendemail->mailTo($Subject,$MailMessage,$row['Email']);
						
						//send alert to portal
						$alertData=array('user_type'=>3,
								'alert_to'=>$user_id,
								'alert_about'=>7,
								'alert_msg'=>$MailMessage,
								'alert_sent'=>4);
						$this->db->insert("notify_alert", $alertData);
					}
				}
			}
			
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
	
	//	http://localhost/Schoooly/index.php/web_services/Attendace_api/LeaveListForAdmin/class_id/1
	function LeaveListForAdmin_get()
    {
		$data = $this->Attendance_model->getLeaveDetailsByClass($this->get('class_id'));
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
	
	//	http://localhost/Schoooly/index.php/web_services/Attendace_api/LeaveListForParent/student_id/1/from_date/2017-01-01/to_date/2017-01-01
	function LeaveListForParent_get()
    {
		$data = $this->Attendance_model->getLeaveDetails($this->get('student_id'),$this->get('from_date'),$this->get('to_date'));
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
	
	//	http://localhost/Schoooly/index.php/web_services/Attendace_api/LeaveListForTransportAdmin/bus_id/1
	function LeaveListForTransportAdmin_get()
    {
		$data = $this->Attendance_model->getLeaveDetailsByBus($this->get('bus_id'));
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
	
	//	http://localhost/Schoooly/index.php/web_services/Attendace_api/LeavePendingListForTeacher/class_id/1/section_id/1
	function LeavePendingListForTeacher_get()
    {
		$data = $this->Attendance_model->getLeavePendingByClass($this->get('class_id'),$this->get('class_id'));
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


	//	http://localhost/Schoooly/index.php/web_services/Attendace_api/LeaveAcceptedListForTeacher/class_id/1/section_id/1/from_date/2017-05-01/to_date/2017-05-05
	function LeaveAcceptedListForTeacher_get()
    {
		$data = $this->Attendance_model->getLeaveAcceptedByClass($this->get('class_id'),$this->get('section_id'),$this->get('from_date'),$this->get('to_date'));
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
	
	//	http://localhost/Schoooly/index.php/web_services/Attendace_api/LeaveApproveForTeacher/student_id/1
	function LeaveApproveForTeacher_post()
    {
		$data = $this->Attendance_model->postLeaveApproveByTeacher($this->post('student_id'));
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
	
	//	http://localhost/Schoooly/index.php/web_services/Attendance_api/addTeacherLeaveRequest/teacher_id/1/from_date/2017-01-01/to_date/2017-01-01/no_of_days/1/reason/fever
	function addTeacherLeaveRequest_post()
    {
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$Year= $query->row('description');
		
		$user_type= $this->db->get_where('hr_roles', array(strtoupper('role') => 'TEACHER'))->row()->id;
		$cur_Date = date("Y-m-d");
		$details=array(
				'student_id' => urldecode($this->post('teacher_id')),
				'user_type' => $user_type,
				'from_date' => urldecode($this->post('from_date')),
				'to_date' => urldecode($this->post('to_date')),
				'no_of_days' => urldecode($this->post('no_of_days')),
				'status' => '1',
				'applied_on' => $cur_Date,
				'year' => $Year,
				'reason' => urldecode($this->post('reason'))
				);
							
		$data = $this->Attendance_model->addTeacherLeaveDetails($details);
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
	
	//	http://localhost/Schoooly/index.php/web_services/Attendance_api/addTeacherLeaveRequest/teacher_id/1/from_date/2017-01-01/to_date/2017-01-01/no_of_days/1/reason/fever
	function deleteLeaveRequest_post()
    {
		
		$data = $this->Attendance_model->deleteLeaveDetails($this->post('leave_id'));
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
	
	//	http://localhost/Schoooly/index.php/web_services/Attendace_api/TeacherLeaveList/teacher_id/1/from_date/2017-05-01/to_date/2017-05-05
	function TeacherLeaveList_get()
    {
		$data = $this->Attendance_model->getTeacherLeaveList($this->get('teacher_id'),$this->get('from_date'),$this->get('to_date'));
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
	
	
}
?>