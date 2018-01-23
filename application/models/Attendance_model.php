<?php
class Attendance_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
		//$this->load->library('apicrypter');
		$this->load->library('GCM');
	}
	
	function getTodaysReport($Stu_Id,$Date)
	{
		$Stu_Ids_List = explode('|',urldecode($Stu_Id));
		$Stu_Ids_Arr = $this ->toInArray($Stu_Ids_List);
		$sql = "SELECT * FROM ".TABLE_ATTENDANCE." WHERE student_id IN (".$Stu_Ids_Arr.") AND att_date='".$Date."'";		
		$query = $this->db->query($sql);
		
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getTodaysReportForTeacher($Class_Id,$Section_Id,$Date)
	{
		$this -> db -> select('*');
		$this -> db -> from(TABLE_ATTENDANCE);
		$this -> db -> where('class_id', $Class_Id);
		$this -> db -> where('section_id', $Section_Id);
		$this -> db -> where('att_date', $Date);
		$query = $this -> db -> get();
		
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$student_id=$row['student_id'];
				$this->db->select('in_status,out_status');
				$this-> db -> from('attendance_driver');
				$this-> db ->where('student_id', $row['student_id']);	
				$this-> db ->where('user_type', 'student');	
				$this-> db ->where('trip_type', '2');	
				$this-> db ->where('att_date', $Date);	
				
				$attData=$this -> db -> get();
				if($attData->row('in_status')==null){
					$row['bus_in']="0";
				}else{
				$row['bus_in']=$attData->row('in_status');	
				}
				if($attData->row('out_status')==null){
					$row['bus_out']="0";
				}else{
					$row['bus_out']=$attData->row('out_status');
				}
				$this->db->select('photo,student_code');
				$this-> db -> from('student');
				$this-> db ->where('student_id', $row['student_id']);	
				$stuData=$this -> db -> get();
				$row['photo']=$stuData->row('photo');
				$row['roll_number']=$stuData->row('student_code');
				
				
				//get attendance percentage
				$id=$row['student_id']; 
				$d=$Date; 
				$query = $this->db->query("SELECT * FROM semester WHERE '$d' >= start_date AND '$d' <= end_date"); 
				if($query->num_rows()>0){
					foreach ($query->result_array() as $row2 ) {
						$st=$row2['start_date'];
						$et=$row2['end_date'];
					}
				}
				$query2 = $this->db->query("SELECT * FROM attendance WHERE student_id = '$id' AND att_date >= '$st' AND att_date <= '$et' AND status = '1'"); 
				if($query2->num_rows()>0){
					$num_days=$query2->num_rows();
				}
				$query3 = $this->db->query("SELECT * FROM attendance WHERE student_id = '$id' AND att_date >= '$st' AND att_date <= '$et' AND status = '1' AND In_Status = '1' "); 
				$num_present=$query3->num_rows();
				$p= ($num_present/$num_days)*100;
				$min = $this->db->get_where('settings' , array('type' => 'attendance_percentage'))->row()->description;
				$per=round($p,2).'%';
				
				$row['percentage']=$per;
				$data[] = $row;
			}
			return $data;
		}
		
	}
	
	function getTodaysReportForDriver($DriverId,$BusId,$Date)
	{
		$this -> db -> select('*');
		$this -> db -> from('attendance_driver');
		$this -> db -> where('driver_id', $DriverId);
		$this -> db -> where('bus_id', $BusId);
		$this -> db -> where('att_date', $Date);
		$query = $this -> db -> get();
		
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getMonthlyReport($Stu_Id,$Att_Month)
	{
		$Stu_Ids_List = explode('|',urldecode($Stu_Id));
		$Stu_Ids_Arr = $this ->toInArray($Stu_Ids_List);
		
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$Year= $query->row('description');
		
		$sql = "SELECT * FROM ".TABLE_ATTENDANCE." WHERE student_id IN (".$Stu_Ids_Arr.") AND att_month='".$Att_Month."' AND year='".$Year."'";		
		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function InsertData($Att_Date, $Att_Month, $Class_Id, $Section_Id,$Stu_Id,$Stu_Name, $In_Status, $Out_Status)
	{
		$Att_Date_arr = explode(',', urldecode($Att_Date));
		$Att_Month_arr = explode(',', urldecode($Att_Month));
		$Class_Id_arr = explode(',', urldecode($Class_Id));
		$Section_Id_arr = explode(',', urldecode($Section_Id));
		$Stu_Id_arr = explode(',', urldecode($Stu_Id));
		$Stu_Name_arr = explode(',', urldecode($Stu_Name));
		$In_Status_arr = explode(',', urldecode($In_Status));
		$Out_Status_arr = explode(',', urldecode($Out_Status));

		
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$Year= $query->row('description');
		
		for ($i = 0; $i < count($Att_Date_arr); $i++){
			$WhereArr=array(
			'att_date' => $Att_Date_arr[$i],
			'student_id' => $Stu_Id_arr[$i]);
			
			$qu = $this->db->get_where(TABLE_ATTENDANCE, $WhereArr);
			$count = $qu->num_rows(); //counting result from query
			if ($count === 0) {
				$dataArr = array(
				'att_date' => $Att_Date_arr[$i],
				'att_month' => $Att_Month_arr[$i],
				'class_id' => $Class_Id_arr[$i],
				'section_id' => $Section_Id_arr[$i],
				'student_id' => $Stu_Id_arr[$i],
				'student_name' => $Stu_Name_arr[$i],
				'timestamp' =>strtotime(date("d-m-Y")),
				'year' => $Year,
				'In_Status' => $In_Status_arr[$i],
				'Out_Status' => $Out_Status_arr[$i]);
				
				$this->db->insert(TABLE_ATTENDANCE, $dataArr);
			}else
			{
				$dataArr = array(
				'att_date' => $Att_Date_arr[$i],
				'att_month' => $Att_Month_arr[$i],
				'class_id' => $Class_Id_arr[$i],
				'section_id' => $Section_Id_arr[$i],
				'student_id' => $Stu_Id_arr[$i],
				'student_name' => $Stu_Name_arr[$i],
				'timestamp' => strtotime(date("d-m-Y")),
				'year' => $Year,
				'In_Status' => $In_Status_arr[$i],
				'Out_Status' => $Out_Status_arr[$i]);
				
				$this->db->where($WhereArr);
				$this->db->update(TABLE_ATTENDANCE,$dataArr);
			}
		}
		return 'Success';		
	}
	
	function InsertDataForDriver($Att_Date, $Att_Month, $driver_id, $bus_id,$trip_type,$Stu_Id,$Stu_Name, $In_Status, $Out_Status, $user_type)
	{
		$Att_Date_arr = explode(',', urldecode($Att_Date));
		$Att_Month_arr = explode(',', urldecode($Att_Month));
		$driver_id_arr = explode(',', urldecode($driver_id));
		$bus_Id_arr = explode(',', urldecode($bus_id));
		$trip_type_arr = explode(',', urldecode($trip_type));
		$Stu_Id_arr = explode(',', urldecode($Stu_Id));
		$Stu_Name_arr = explode(',', urldecode($Stu_Name));
		$In_Status_arr = explode(',', urldecode($In_Status));
		$Out_Status_arr = explode(',', urldecode($Out_Status));
		$user_type_arr = explode(',', urldecode($user_type));

		
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$Year= $query->row('description');
		
		for ($i = 0; $i < count($Att_Date_arr); $i++){
			$WhereArr=array(
			'att_date' => $Att_Date_arr[$i],
			'student_id' => $Stu_Id_arr[$i],
			'trip_type' => $trip_type_arr[$i],
			'user_type' => $user_type_arr[$i]
			);
		
			$qu = $this->db->get_where('attendance_driver', $WhereArr);
			$count = $qu->num_rows(); //counting result from query
			if ($count === 0) {
				$dataArr = array(
				'att_date' => $Att_Date_arr[$i],
				'att_month' => $Att_Month_arr[$i],
				'driver_id' => $driver_id_arr[$i],
				'bus_id' => $bus_Id_arr[$i],
				'trip_type' => $trip_type_arr[$i],
				'student_id' => $Stu_Id_arr[$i],
				'student_name' => $Stu_Name_arr[$i],
				'year' => $Year,
				'In_Status' => $In_Status_arr[$i],
				'Out_Status' => $Out_Status_arr[$i],
				'user_type' => $user_type_arr[$i]);
				
				$this->db->insert('attendance_driver', $dataArr);
			}else
			{
				$dataArr = array(
				'att_date' => $Att_Date_arr[$i],
				'att_month' => $Att_Month_arr[$i],
				'driver_id' => $driver_id_arr[$i],
				'bus_id' => $bus_Id_arr[$i],
				'trip_type' => $trip_type_arr[$i],
				'student_id' => $Stu_Id_arr[$i],
				'student_name' => $Stu_Name_arr[$i],
				'year' => $Year,
				'In_Status' => $In_Status_arr[$i],
				'Out_Status' => $Out_Status_arr[$i],
				'user_type' => $user_type_arr[$i]);
				
				$this->db->where($WhereArr);
				$this->db->update('attendance_driver',$dataArr);
			}
			//Send Push notify
			$cur_Date = date("Y-m-d");
			if($user_type_arr[$i]=='student'){
				
				$Attquery=$this->db->query("SELECT G.GCM_RegId,A.In_Status,A.Out_Status,A.student_name FROM ".TABLE_GCM." G 
				INNER JOIN ".TABLE_STUDENTS." S ON
				G.User_Id=S.parent_id INNER JOIN attendance_driver A ON
				S.student_id=A.student_id WHERE G.User_Id IN 
				(SELECT S.parent_id FROM ".TABLE_STUDENTS." WHERE S.student_id IN 
				(SELECT A.student_id FROM attendance_driver WHERE A.att_date= '".$cur_Date."' 
				AND A.student_id='".$Stu_Id_arr[$i]."' AND A.trip_type='".$trip_type_arr[$i]."')) 
				AND G.User_Type='parent'");
				
				if($Attquery->num_rows() > 0) {
					foreach ($Attquery->result_array() as $row1) {
						$InStatus=$row1['In_Status'];
						$OutStatus=$row1['Out_Status'];
						$Stu_Name=$row1['student_name'];
						if($trip_type_arr[$i]==1){
							
							if($InStatus==1 && $OutStatus==2)
							{
								$message = array("Notification" => $Stu_Name." has boarded the bus and is on his way to school.".date("h:i a"),"image_url" => "");	
							}else if($InStatus==1 && $OutStatus==1){
								$message = array("Notification" => "Bus has reached School. ".$Stu_Name." has disembarked and headed to class.".date("h:i a") ,"image_url" => "");	
							}
							else if($InStatus==2){
								$message = array("Notification" => "Assalamu’alaikum! your child is Absent today" ,"image_url" => "");	
							}
							$this->gcm->clearRecepients();
							$this->gcm->addRecepient($row1['GCM_RegId']);
							$this->gcm->setData($message);
							$Type='parent';
							$this->gcm->send($Type);
						}else if($trip_type_arr[$i]==2){
							
							if($InStatus==1 && $OutStatus==2)
							{
								$message = array("Notification" => $Stu_Name."  is in the school bus now and will start shortly on the trip back home.".date("h:i a") ,"image_url" => "");	
							}else if($InStatus==1 && $OutStatus==1){
								$message = array("Notification" => "Bus has reached home. ".$Stu_Name." has disembarked and headed to home.".date("h:i a") ,"image_url" => "");	
							}
							else if($InStatus==2){
								$message = array("Notification" => "Assalamu’alaikum! your child is Absent today" ,"image_url" => "");	
							}
							$this->gcm->clearRecepients();
							$this->gcm->addRecepient($row1['GCM_RegId']);
							$this->gcm->setData($message);
							$Type='parent';
							$this->gcm->send($Type);
						}					
					}
				}	
			}
		}
		
		return true;		
	}
	
	function getReportByBus($Route_Id,$Date,$trip_type)
	{
		$sql = "SELECT s.parent_id,s.photo,a.att_id,a.att_date,a.att_month,a.year,a.student_id,a.student_name,a.trip_type,a.driver_id,a.driver_name,a.bus_id,a.in_status,a.out_status 
			FROM attendance_driver a INNER JOIN student s ON a.student_id=s.student_id WHERE a.bus_id 
			IN (SELECT bus_id FROM routes WHERE route_id='".$Route_Id."') AND a.att_date='".$Date."' AND a.trip_type='".$trip_type."'";		
		$query = $this->db->query($sql);
		
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$this->db->select('name,Father_Primary_Mobile');
				$this-> db -> from('parent');
				$this-> db ->where('parent_id', $row['parent_id']);
				$parentData=$this -> db -> get();
				$row['parent_name'] = $parentData->row()->name;
				$row['parent_contact'] = $parentData->row()->Father_Primary_Mobile;
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getTodaysBusAttendance($Stu_Id,$Date)
	{
		$Stu_Ids_List = explode('|',urldecode($Stu_Id));
		$Stu_Ids_Arr = $this ->toInArray($Stu_Ids_List);
		
	/*	$this -> db -> select('*');
		$this -> db -> from('attendance_driver');
		$this -> db -> where_in('student_id',$Stu_Ids_Arr);
		$this -> db -> where('att_date', $Date);
		$this -> db -> where('trip_type', $trip_type);
		$query = $this->db->get();*/
		
		//AND trip_type='".$trip_type."'
		$sql = "SELECT * FROM attendance_driver WHERE student_id IN (".$Stu_Ids_Arr.") AND att_date='".$Date."'";		
		$query = $this->db->query($sql);
		
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getBusAttendanceReport($Stu_Id,$Start_date,$End_date)
	{
		$Stu_Ids_List = explode('|',urldecode($Stu_Id));
		$Stu_Ids_Arr = $this ->toInArray($Stu_Ids_List);
		
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$Year= $query->row('description');
		
		$sql = "SELECT * FROM attendance_driver WHERE student_id IN (".$Stu_Ids_Arr.") AND att_date>='".$Start_date."' AND att_date<='".$End_date."' AND year='".$Year."'";		
		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	
	
	function InsertMisbehavior($details){
		$this->db->insert("misbehave", $details);
		$bus_id = $this->db->insert_id();	
		return $bus_id;		
	}
	
	
	function getMisbehaveByBus($bus_id)
	{
		$this -> db -> select('*');	 
		$this -> db -> from('misbehave');
		$this-> db -> where('bus_id', $bus_id);
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$this->db->select('name');
				$this-> db -> from('student');
				$this-> db ->where('student_id', $row['student_id']);
				$row['student_name'] = $this -> db -> get()->row()->name;
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function addLeaveDetails($details){
		//$this->db->insert("leave_records", $details);
		//$bus_id = $this->db->insert_id();	
		//return $bus_id;
		
		extract($details);
		
		$WhereArr=array(
			'student_id' => $student_id,
			'user_type' => $user_type,
			'from_date' => $from_date,
			'to_date' => $to_date,
			'year' => $year,
			'status' => 3
			);
		
			$qu = $this->db->get_where('leave_records', $WhereArr);
			$count = $qu->num_rows(); //counting result from query
			if ($count == 0) {
				$this->db->insert('leave_records', $details);
			}else{
				$this->db->where($WhereArr);
				$this->db->update('leave_records',$details);
			}
		//$this->db->insert("leave_records", $details);
		//$_id = $this->db->insert_id();	
		return true;	
	}
	
	function editLeaveDetails($leave_id,$status,$reason){
		
		$details=array(
				'status' => $status,
				'reject_reason' => $reason
				);
		$this->db->where('id',$leave_id);
		$this->db->update('leave_records',$details);
		
		if($status=='2'){
			$this->db->select('student_id,from_date,to_date');
			$this-> db -> from('leave_records');
			$this-> db ->where('id', $leave_id);
			$query = $this -> db -> get();
			
			$student_id=$query->row()->student_id;
			$from_date=$query->row()->from_date;
			$to_date=$query->row()->to_date;
			
			while (strtotime($from_date) <= strtotime($end_date)) {
				$WhereArr=array(
				'att_date' => $from_date,
				'student_id' => $student_id);
				
				$this->db->where($WhereArr);
				$this->db->update('attendance',array('status' => 6));
				
				$from_date = date ("Y-m-d", strtotime("+1 day", strtotime($from_date)));
			}
		}
		return true;		
	}
	
	function getLeaveDetails($Stu_Id,$Start_date,$End_date)
	{
		$sql = "SELECT * FROM leave_records WHERE student_id=".$Stu_Id." AND user_type=0 AND applied_on>='".$Start_date."' AND applied_on<='".$End_date."'";		
		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}else{
			return false;
		}
	}
	
function getLeaveDetailsByClass($class_id)
	{
		$sql = "SELECT * FROM leave_records WHERE student_id IN (SELECT student_id FROM student WHERE class_id='".$class_id."')  AND user_type=0";		
		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$this->db->select('name');
				$this-> db -> from('student');
				$this-> db ->where('student_id', $row['student_id']);
				$row['student_name'] = $this -> db -> get()->row()->name;
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getLeaveDetailsByBus($bus_id)
	{
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$Year= $query->row('description');
		
		$sql = "SELECT * FROM leave_records WHERE student_id IN 
			(SELECT student_id FROM student WHERE assigned_bus='".$bus_id."') 
			AND user_type=0 AND year='".$Year."'";	
			
		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$this->db->select('name');
				$this-> db -> from('student');
				$this-> db ->where('student_id', $row['student_id']);
				$row['student_name'] = $this -> db -> get()->row()->name;
				$data[] = $row;
			}
			return $data;
		}
	}

	function getLeavePendingByClass($class_id,$section_id)
	{
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$Year= $query->row('description');
		
		$sql = "SELECT * FROM leave_records WHERE student_id IN 
			(SELECT student_id FROM student WHERE class_id='".$class_id."' AND section_id='".$section_id."') 
			AND user_type=0 AND year='".$Year."' AND status=1";	
			
		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$this->db->select('name');
				$this-> db -> from('student');
				$this-> db ->where('student_id', $row['student_id']);
				$row['student_name'] = $this -> db -> get()->row()->name;
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getLeaveAcceptedByClass($class_id,$section_id,$from_date,$to_date)
	{
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$Year= $query->row('description');
		
		$sql = "SELECT * FROM leave_records WHERE student_id IN 
			(SELECT student_id FROM student WHERE class_id='".$class_id."' AND section_id='".$section_id."') 
			AND user_type=0 AND year='".$Year."' AND applied_on>='".$from_date."' AND applied_on<='".$to_date."' AND status IN (2,3)" ;	
			
		$query = $this->db->query($sql);
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$this->db->select('name');
				$this-> db -> from('student');
				$this-> db ->where('student_id', $row['student_id']);
				$row['student_name'] = $this -> db -> get()->row()->name;
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getTeacherLeaveList($teacher_id,$from_date,$to_date)
	{
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$Year= $query->row('description');
		
		$user_type= $this->db->get_where('hr_roles', array(strtoupper('role') => 'TEACHER'))->row()->id;
		
		$status=array(1,2,3);
		$this->db->select('id,student_id as teacher_id,from_date,to_date,no_of_days,reason,status,applied_on,reject_reason');
		$this-> db -> from('leave_records');
		$this-> db ->where('student_id',$teacher_id);
		$this-> db ->where('user_type',$user_type);
		$this-> db ->where('year',$Year);
		$this-> db ->where('applied_on>=',$from_date);
		$this-> db ->where('applied_on<=',$to_date);
		$this-> db ->where_in('status',$status);
		
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$this->db->select('name');
				$this-> db -> from('employee_details');
				$this-> db ->where('emp_id', $row['teacher_id']);
				$row['teacher_name'] = $this -> db -> get()->row()->name;
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function getLeaveDetailsForTransportAdmin($user_type,$user_id,$from_date,$to_date)
	{
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$Year= $query->row('description');
		
		
		$status=array(1,2,3);
		$this->db->select('*');
		$this-> db -> from('leave_records');
		if($user_id!=0){
			$this-> db ->where('student_id',$user_id);
		}		
		
		$this-> db ->where('user_type',$user_type);
		$this-> db ->where('year',$Year);
		$this-> db ->where('applied_on>=',$from_date);
		$this-> db ->where('applied_on<=',$to_date);
		$this-> db ->where_in('status',$status);
		
		$query = $this->db->get();
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function addTeacherLeaveDetails($details){
		
		$this->db->insert("leave_records", $details);
		$_id = $this->db->insert_id();	
		return $_id;		
	}
	
	function deleteLeaveDetails($leave_id){
		$this->db->where('id', $leave_id);
		$this->db->delete('leave_records'); 
		return true;
	}
	
	function toInArray($cus_ids){
		$res_id_arr ='';
		foreach($cus_ids as $cus_id){
			$res_id_arr .= "'".$cus_id."',";
		}
		$res_id_arr = rtrim($res_id_arr,",");
		return $res_id_arr;
	}
}
?>