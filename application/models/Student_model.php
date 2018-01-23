<?php
class Student_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
	}

	
	function getStudentList($Class_Id,$Section_Id)
	{
		$q = $this->db->query("SELECT S.student_id,S.name,S.parent_id,S.student_code FROM ".TABLE_STUDENTS." S INNER JOIN ".TABLE_ENROLL." E ON E.student_id=S.student_id WHERE E.class_id=".$Class_Id." AND E.section_id=".$Section_Id."  AND S.Student_Status=1");
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
		/*$this -> db -> select('student_id,name,parent_id,address');
		$this -> db -> from(TABLE_STUDENTS);
		$this -> db -> where('class_id', $Class_Id);
		$this -> db -> where('section_id', $Section_Id);
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {					
				$data[] = $row;					
			}
			return $data;
		}else{
			return false;
		}*/
	}

	function getStudentListByBusId($id)
	{
		$this -> db -> select('emp_id AS teacher_id, name,latitude AS Latitude,longitude As Longitude');
	    $this -> db -> from('employee_details');
	    $this -> db -> where('assigned_bus', $id);	   
	    $query1 = $this->db->get();
		if($query1->num_rows() > 0){
			foreach (($query1->result_array()) as $row1) {	
				$row1['photo']="";
				$data[] = $row1;					
			}
		}
		$this -> db -> select('student_id, name,Latitude,Longitude,photo');
	    $this -> db -> from(TABLE_STUDENTS);
	    $this -> db -> where('assigned_bus', $id);	   
	    $query = $this->db->get();
		if($query->num_rows() > 0){
			foreach (($query->result_array()) as $row) {	
				$data[] = $row;					
			}
			return $data;
		}else{
			return false;
		}
	}
	
	function getStudentListByRouteId($trip_type,$route_id)
	{
		//get teacher list
		
		$query1=$this->db->query("SELECT emp_id AS teacher_id, name,latitude AS Latitude,longitude As Longitude FROM employee_details
			WHERE (pickup_route_id=".$route_id." OR drop_route_id=".$route_id.") AND emp_id 
			NOT IN (SELECT student_id FROM attendance_driver WHERE att_date='".date("Y-m-d")."' 
				AND trip_type=".$trip_type." AND user_type='teacher')");
		if($query1->num_rows() > 0){
			foreach (($query1->result_array()) as $row1) {	
				$row1['photo']="";
				$data[] = $row1;					
			}
		}
		
		//get students
		$query=$this->db->query("SELECT student_id, name,Latitude,Longitude,photo FROM student
			WHERE (pickup_route_id=".$route_id." OR drop_route_id=".$route_id.") AND student_id 
			NOT IN(SELECT student_id FROM attendance_driver WHERE att_date='".date("Y-m-d")."' 
				AND trip_type=".$trip_type." AND user_type='student')");
				
		if($query->num_rows() > 0){
			foreach (($query->result_array()) as $row) {	
				$data[] = $row;					
			}
			return $data;
		}else{
			return false;
		}
	}
	
	function getStudentsAttendanceByRoute($route_id,$user_type)
	{
		//get route's trip type
		$this -> db -> select('trip_type');
		$this -> db -> from('routes');
		$this->db->where('route_id',$route_id);
		$trip_type = $this->db->get()->row('trip_type');
			
		$cur_Date = date("Y-m-d");
		
		if($user_type==1){		
		//get students
			$this -> db -> select('student_id, name,photo,student_code');
			$this -> db -> from(TABLE_STUDENTS);
			$this -> db -> where('pickup_route_id', $route_id);	   	
			$this -> db -> or_where('drop_route_id', $route_id);	   
			$query = $this->db->get();
			if($query->num_rows() > 0){
				foreach (($query->result_array()) as $row) {
					//get student iqama_id
					$this -> db -> select('iqama_id');
					$this -> db -> from('student_documents');
					$this->db->where('student_id',$row['student_id']);
					$iqama_number = $this->db->get()->row('iqama_id');

					$row['iqama_number']=$iqama_number;
					$row['trip_type']=$trip_type;
					//get attendance status
					$this -> db -> select('in_status,out_status');
					$this -> db -> from('attendance_driver');
					$this->db->where('student_id',$row['student_id']);
					$this->db->where('att_date',$cur_Date);
					$this->db->where('trip_type',$trip_type);
					$this->db->where('user_type','student');
					$att_query=$this->db->get();
					if($att_query->row('in_status')){
						$row['in_status']=$att_query->row('in_status');
					}else{
						$row['in_status']=0;
					}
					if($att_query->row('out_status')){
						$row['out_status']=$att_query->row('out_status');
					}else{
						$row['out_status']=0;
					}	
					$data[] = $row;					
				}
				return $data;
			}else{
				return false;
			}
		}else{		
		//get teacher
			$this -> db -> select('emp_id as student_id, name,photo,iqama_number');
			$this -> db -> from('employee_details');
			$this -> db -> where('pickup_route_id', $route_id);	   	
			$this -> db -> or_where('drop_route_id', $route_id);	   
			$query = $this->db->get();
			if($query->num_rows() > 0){
				foreach (($query->result_array()) as $row) {
					$row['trip_type']=$trip_type;
					//get attendance status
					$this -> db -> select('in_status,out_status');
					$this -> db -> from('attendance_driver');
					$this->db->where('student_id',$row['student_id']);
					$this->db->where('att_date',$cur_Date);
					$this->db->where('trip_type',$trip_type);
					$this->db->where('user_type','teacher');
					$att_query=$this->db->get();
					if($att_query->row('in_status')){
						$row['in_status']=$att_query->row('in_status');
					}else{
						$row['in_status']=0;
					}
					if($att_query->row('out_status')){
						$row['out_status']=$att_query->row('out_status');
					}else{
						$row['out_status']=0;
					}	
					$data[] = $row;					
				}
				return $data;
			}else{
				return false;
			}
		}
	}
	
	function getOnlyStudentListByBusId($id)
	{
		$this -> db -> select('student_id, parent_id,name,class_id,class_name,section_id,section_name');
	    $this -> db -> from(TABLE_STUDENTS);
	    $this -> db -> where('assigned_bus', $id);	   
	    $query = $this->db->get();
		if($query->num_rows() > 0){
			foreach (($query->result_array()) as $row) {	
			
				$this -> db -> select('Father_Primary_Mobile,Mother_Primary_Mobile');
				$this -> db -> from('parent');
				$this->db->where('parent_id',$row['parent_id']);
				$contact_query=$this->db->get();
				
				$row['Father_Primary_Mobile'] = $contact_query->row('Father_Primary_Mobile');
				$row['Mother_Primary_Mobile'] = $contact_query->row('Mother_Primary_Mobile');
				
				$data[] = $row;					
			}
			return $data;
		}else{
			return false;
		}
	}

	function getAllStudentList($trip_type)
	{
		$this -> db -> select('student_id,photo, parent_id,class_name,section_name,name,Latitude AS latitude,Longitude AS langitude,pickup_route_id,drop_route_id,journey_type,journey_trip');
	    $this -> db -> from(TABLE_STUDENTS);
	    $this -> db -> where('Transport_Facility','1');
	    $query = $this->db->get();
		if($query->num_rows() > 0){
			foreach (($query->result_array()) as $row) {
				$row['assigned_to']=$row['student_id']."-student";
				if($row['journey_type']==1){
					if($row['journey_trip']==$trip_type){
						$this -> db -> select('Father_Primary_Mobile');
						$this -> db -> from('parent');
						$this->db->where('parent_id',$row['parent_id']);
						$row['contact_num'] = $this->db->get()->row('Father_Primary_Mobile');
						$data[] = $row;					
					}
				}else{
					$this -> db -> select('Father_Primary_Mobile');
					$this -> db -> from('parent');
					$this->db->where('parent_id',$row['parent_id']);
					$row['contact_num'] = $this->db->get()->row('Father_Primary_Mobile');
					$data[] = $row;					
				}
			}
			return $data;
		}else{
			return false;
		}
	}
	
	function getAllTeachersList()
	{
		$this -> db -> select('emp_id AS teacher_id, name,photo,mobile,latitude,longitude AS langitude,pickup_route_id,drop_route_id');
	    $this -> db -> from('employee_details');
	    $query = $this->db->get();
		if($query->num_rows() > 0){
			foreach (($query->result_array()) as $row) {			
				$row['assigned_to']=$row['teacher_id']."-teacher";			
				$data[] = $row;					
			}
			return $data;
		}else{
			return false;
		}
	}
	
	function getClassDet()
	{
	   $this -> db -> select('Class_Id, Class_Name');
	   $this -> db -> from(TABLE_CLASS);		   	 
	   $query = $this -> db -> get();
	 
		   if($query->num_rows() > 0) {
				foreach (($query->result_array()) as $row) {					
					$data[$row['Class_Id']] = $row['Class_Name'];					
				}				
			return $data;
		   }else{
				return false;
		   }
	}

	function getMarklistByClass($Class_Id,$Section_Id)
	{
		$this -> db -> select('*');
		$this -> db -> from('mark');		   	 
		$this -> db -> where('class_id',$Class_Id);		   	 
		$this -> db -> where('section_id',$Section_Id);		   	 
		$this -> db -> where('status',1);		   	 
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$row['student_name']=$this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name;				
				$row['subject_name']=$this->db->get_where('subject', array('subject_id' => $row['subject_id']))->row()->name;				
				$row['exam_name']=$this->db->get_where('exam_schedule', array('_id' => $row['exam_id']))->row()->title;				
				$data[] = $row;					
			}				
			return $data;
		}else{
			return false;
		}
	}

	function getMarklistReportByClass($Class_Id,$Section_Id)
	{
		/*$this -> db -> select('*');
		$this -> db -> from('mark');		   	 
		$this -> db -> where('class_id',$Class_Id);		   	 
		$this -> db -> where('section_id',$Section_Id);		   	 
		$this -> db -> where('status',2);		   	 
		$query = $this -> db -> get();*/
		
		$query=$this->db->query("SELECT M.mark_id,M.student_id,M.subject_id,M.class_id,M.section_id,M.exam_id,M.mark_obtained,M.mark_total,C.comment FROM mark M 
			INNER JOIN mark_sheet_comments C ON M.student_id=C.student_id AND M.exam_id=C.exam_id 
			WHERE M.class_id=".$Class_Id." AND M.section_id=".$Section_Id." AND M.status=2");
				
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$row['student_name']=$this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name;				
				$row['subject_name']=$this->db->get_where('subject', array('subject_id' => $row['subject_id']))->row()->name;				
				$row['exam_name']=$this->db->get_where('exam_schedule', array('_id' => $row['exam_id']))->row()->title;				
				$data[] = $row;					
			}				
			return $data;
		}else{
			return false;
		}
	}

	function updateCoordinatesByStuId($Lat,$Lang,$parent_id,$Street_Name,$Area,$Landmark,$Lanmark_url){
		
		$img = str_replace('|', '/', urldecode($Lanmark_url));
		$valArr=array('Latitude'=>urldecode($Lat),
					'Longitude'=>urldecode($Lang),
					'Street_Name'=>urldecode($Street_Name),
					'Area'=>urldecode($Area),
					'Lanmark_url'=>$img,
					'Landmark'=>urldecode($Landmark));
		$this->db->where('parent_id',$parent_id);
		if( $this->db->update(TABLE_STUDENTS,$valArr))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function updateRadius($trip_type,$radius,$parent_id){
		
		$valArr=array();
		if($trip_type=='Pickup'){
			$valArr=array('pickup_radius'=>urldecode($radius));
		}else{
			$valArr=array('drop_radius'=>urldecode($radius));
		}
		
		$this->db->where('parent_id',$parent_id);
		if( $this->db->update(TABLE_STUDENTS,$valArr))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	//updateStudentAttendace for outbox feature
	function updateStudentAttendace($trip_type,$route_id,$student_id,$student_name,$user_type){
		
		$cur_Date = date("Y-m-d");
		$cur_Month = date("F");
		//get running year
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$Year= $query->row('description');
		
		//get driver_id and bus_id from the route_id
		$this -> db -> select('driver_id,bus_id');
		$this -> db -> from('routes');
		$this -> db -> where('route_id',$route_id);
		$query1 = $this->db->get();
		$driver_id=$query1->row('driver_id');
		$bus_id=$query1->row('bus_id');
		
		$valArr=array(
		'att_date'=>$cur_Date,
		'att_month'=>$cur_Month,
		'year'=>$Year,
		'user_type'=>$user_type,
		'student_id'=>$student_id,
		'student_name'=>urldecode($student_name),
		'trip_type'=>$trip_type,
		'driver_id'=>$driver_id,
		'bus_id'=>$bus_id,
		'in_status'=>2,
		'out_status'=>2,
		'update_by'=>2,
		'updated_on'=>date("Y-m-d h:m:s")
		);
		
		$this->db->where('student_id',$student_id);
		$this->db->where('att_date',$cur_Date);
		$this->db->where('trip_type',$trip_type);
		$this->db->where('user_type',$user_type);
		$q = $this->db->get('attendance_driver');
		if ($q->num_rows() > 0) 
		{
			$this->db->where('student_id',$student_id);
			$this->db->where('att_date',$cur_Date);
			$this->db->where('trip_type',$trip_type);
			$this->db->where('user_type',$user_type);
			$this->db->update('attendance_driver',$valArr);
		} else {
			$this->db->insert('attendance_driver',$valArr);
		}
		
		//get class_id & section_id from the student_id
		$this -> db -> select('class_id,section_id');
		$this -> db -> from('student');
		$this -> db -> where('student_id',$student_id);
		$query1 = $this->db->get();
		$class_id=$query1->row('class_id');
		$section_id=$query1->row('section_id');
		
		//Update out in class attendance
		$dataArr = array(
				'att_date'=>$cur_Date,
				'att_month'=>$cur_Month,
				'class_id' => $class_id,
				'section_id' => $section_id,
				'student_id' => $student_id,
				'student_name' => urldecode($student_name),
				'timestamp' => strtotime(date("d-m-Y")),
				'year' => $Year,
				'In_Status' => 2,
				'Out_Status' => 2);
				
		$WhereArr=array(
			'att_date' => $cur_Date,
			'student_id' => $student_id);
		$this->db->where($WhereArr);
		$this->db->update(TABLE_ATTENDANCE,$dataArr);
		
		return true;
	}
	
	//updateStudentBusAttendace       
	function updateAttendaceByAdmin($trip_type,$route_id,$student_id,$student_name,$user_type,$in_status,$out_status){
		
		$cur_Date = date("Y-m-d");
		$cur_Month = date("F");
		//get running year
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$Year= $query->row('description');
		
		//get driver_id and bus_id from the route_id
		$this -> db -> select('driver_id,bus_id');
		$this -> db -> from('routes');
		$this -> db -> where('route_id',$route_id);
		$query1 = $this->db->get();
		$driver_id=$query1->row('driver_id');
		$bus_id=$query1->row('bus_id');
		
		
		$valArr=array(
		'att_date'=>$cur_Date,
		'att_month'=>$cur_Month,
		'year'=>$Year,
		'user_type'=>$user_type,
		'student_id'=>$student_id,
		'student_name'=>urldecode($student_name),
		'trip_type'=>$trip_type,
		'driver_id'=>$driver_id,
		'bus_id'=>$bus_id,
		'in_status'=>$in_status,
		'out_status'=>$out_status,
		'update_by'=>2,
		'updated_on'=>date("Y-m-d h:m:s")
		);
		
		$this->db->where('student_id',$student_id);
		$this->db->where('att_date',$cur_Date);
		$this->db->where('trip_type',$trip_type);
		$this->db->where('user_type',$user_type);
		$q = $this->db->get('attendance_driver');
		if ($q->num_rows() > 0) 
		{
			$this->db->where('student_id',$student_id);
			$this->db->where('att_date',$cur_Date);
			$this->db->where('trip_type',$trip_type);
			$this->db->where('user_type',$user_type);
			$this->db->update('attendance_driver',$valArr);
		} else {
			$this->db->insert('attendance_driver',$valArr);
		}
		return true;
	}
	
	//updateStudentAttendace for outbox feature
	function updateStudentOutAttendaceByTeacher($student_id,$student_name){
		
		$cur_Date = date("Y-m-d");
		$cur_Month = date("F");
		//get running year
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'running_year');
		$query = $this->db->get();
		$Year= $query->row('description');
	
	//get route_id from the student_id
		$this -> db -> select('drop_route_id,class_id,section_id');
		$this -> db -> from('student');
		$this -> db -> where('student_id',$student_id);
		$query1 = $this->db->get();
		$route_id=$query1->row('drop_route_id');
		$class_id=$query1->row('class_id');
		$section_id=$query1->row('section_id');
		
	
		//get driver_id and bus_id from the route_id
		$this -> db -> select('driver_id,bus_id');
		$this -> db -> from('routes');
		$this -> db -> where('route_id',$route_id);
		$query1 = $this->db->get();
		$driver_id=$query1->row('driver_id');
		$bus_id=$query1->row('bus_id');
		
		$user_type="student";
		$trip_type="2";
		
		$valArr=array(
		'att_date'=>$cur_Date,
		'att_month'=>$cur_Month,
		'year'=>$Year,
		'user_type'=>$user_type,
		'student_id'=>$student_id,
		'student_name'=>urldecode($student_name),
		'trip_type'=>$trip_type,
		'driver_id'=>$driver_id,
		'bus_id'=>$bus_id,
		'in_status'=>2,
		'out_status'=>2,
		'update_by'=>3,
		'updated_on'=>date("Y-m-d h:m:s")
		);
		
		$this->db->where('student_id',$student_id);
		$this->db->where('att_date',$cur_Date);
		$this->db->where('trip_type',$trip_type);
		$this->db->where('user_type',$user_type);
		$q = $this->db->get('attendance_driver');
		if ($q->num_rows() > 0) 
		{
			$this->db->where('student_id',$student_id);
			$this->db->where('att_date',$cur_Date);
			$this->db->where('trip_type',$trip_type);
			$this->db->where('user_type',$user_type);
			$this->db->update('attendance_driver',$valArr);
		} else {
			$this->db->insert('attendance_driver',$valArr);
		}
		
		//Update out in class attendance
		$dataArr = array(
				'att_date'=>$cur_Date,
				'att_month'=>$cur_Month,
				'class_id' => $class_id,
				'section_id' => $section_id,
				'student_id' => $student_id,
				'student_name' => urldecode($student_name),
				'timestamp' => strtotime(date("d-m-Y")),
				'year' => $Year,
				'In_Status' => 2,
				'Out_Status' => 2);
				
		$WhereArr=array(
			'att_date' => $cur_Date,
			'student_id' => $student_id);
		$this->db->where($WhereArr);
		$this->db->update(TABLE_ATTENDANCE,$dataArr);
				
		return true;
	}
}
?>