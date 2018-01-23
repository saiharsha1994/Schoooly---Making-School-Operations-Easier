<?php
class Getroutedetails_model extends CI_Model {
	function __construct()
	{
		parent::__construct();
		$this->load->library('ApiCrypter');
	}
	
	function getRouteForDriverId($driver_id,$trip_type,$route_id)
	{
		//get school location
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'school_location');
		$query = $this->db->get();
		$school_location = explode(",",$query->row('description'));
		
		$lat = $school_location[0];
		$lon = $school_location[1];
		
		//get route optimize status
		$optimize=$this->db->get_where('routes' , array('route_id' => $route_id))->row()->optimize;
		//1=> return optimized route; 2=> return non optimize route
		
		if($trip_type==1){
			if($optimize==1){
				$query1=$this->db->query("SELECT stop_name,stope_time,latitude,langitude,numeric_order,assigned_to,(3959 * acos
					(cos( radians(".$lat.") ) * 
					cos( radians( latitude ) ) * 
					cos( radians( langitude ) - 
					radians(".$lon.") ) + 
					sin( radians(".$lat.") ) * 
					sin( radians( latitude ) ) ) ) AS distance FROM route_stops 
				WHERE route_id=".$route_id." AND (assigned_id,assigned_type) NOT IN (SELECT student_id,user_type FROM attendance_driver 
				WHERE att_date='".date("Y-m-d")."' AND trip_type=".$trip_type.") ORDER BY distance DESC");
			}else{
				$query1=$this->db->query("SELECT stop_name,stope_time,latitude,langitude,numeric_order,assigned_to FROM route_stops 
					WHERE route_id=".$route_id." AND (assigned_id,assigned_type) NOT IN (SELECT student_id,user_type FROM attendance_driver 
					WHERE att_date='".date("Y-m-d")."' AND trip_type=".$trip_type.")");
			}
		}else{
			if($optimize==1){
				$query1=$this->db->query("SELECT stop_name,stope_time,latitude,langitude,numeric_order,assigned_to,(3959 * acos
					(cos( radians(".$lat.") ) * 
					cos( radians( latitude ) ) * 
					cos( radians( langitude ) - 
					radians(".$lon.") ) + 
					sin( radians(".$lat.") ) * 
					sin( radians( latitude ) ) ) ) AS distance FROM route_stops 
				WHERE route_id=".$route_id." AND (assigned_id,assigned_type) NOT IN (SELECT student_id,user_type FROM attendance_driver 
				WHERE att_date='".date("Y-m-d")."' AND trip_type=".$trip_type.") ORDER BY distance ASC");
			}else{
				$query1=$this->db->query("SELECT stop_name,stope_time,latitude,langitude,numeric_order,assigned_to FROM route_stops 
					WHERE route_id=".$route_id." AND (assigned_id,assigned_type) NOT IN (SELECT student_id,user_type FROM attendance_driver 
					WHERE att_date='".date("Y-m-d")."' AND trip_type=".$trip_type.")");
			}
		}
		
		/*$query=$this->db->query("SELECT stop_name,stope_time,latitude,langitude,numeric_order,assigned_to FROM route_stops AS r
		WHERE route_id=".$route_id." AND NOT EXISTS(SELECT 1 FROM attendance_driver AS a
		WHERE r.assigned_id=a.student_id AND r.assigned_type=a.user_type 
		AND att_date='".date("Y-m-d")."' AND trip_type=".$trip_type.")");*/
		if($query1->num_rows() > 0) {
			foreach (($query1->result_array()) as $row) {
				$assigning_to = explode("-",$row['assigned_to']);
				if($assigning_to[1]=='student'){
					$this -> db -> select('pickup_radius,drop_radius');
					$this -> db -> from('student');
					$this -> db -> where('student_id', $assigning_to[0]);
					$query1 = $this -> db -> get();		
					if($query1->num_rows() > 0) {
						foreach (($query1->result_array()) as $row1) {
							$row['pickup_eta']=$row1['pickup_radius'];
							$row['drop_eta']=$row1['drop_radius'];
						}
					}
				}else{
					$this -> db -> select('pickup_radius,drop_radius');
					$this -> db -> from('employee_details');
					$this -> db -> where('emp_id', $assigning_to[0]);
					$query1 = $this -> db -> get();		
					if($query1->num_rows() > 0) {
						foreach (($query1->result_array()) as $row1) {
							$row['pickup_eta']=$row1['pickup_radius'];
							$row['drop_eta']=$row1['drop_radius'];
						}
					}

				}
				$data[] = $row;
			}
			return $data;
		}else{
			return false;
		}
	}	
		
	function getStopListByRouteId($route_id,$traveller_type)
	{
		$data=array();
		//get school location
		$this -> db -> select('*');
		$this -> db -> from(TABLE_SETTING);
		$this -> db -> where('type', 'school_location');
		$query = $this->db->get();
		$school_location = explode(",",$query->row('description'));
		
		$lat = $school_location[0];
		$lon = $school_location[1];
		
		//get trip_type by route_id and optimize
		$this -> db -> select('trip_type,optimize');
		$this -> db -> from('routes');
		$this->db->where('route_id',$route_id);
		$result=$this->db->get();
		$trip_type = $result->row('trip_type');
		$optimize = $result->row('optimize');
		//1=> return optimized route; 2=> return non optimize route
		if($optimize==1){
			//sorting coordinates near from the school location
			$this -> db -> select('route_stops_id,stop_name,stope_time,latitude,langitude,assigned_to,
				(3959 * acos
				(cos( radians('.$lat.') ) * 
				cos( radians( latitude ) ) * 
				cos( radians( langitude ) - 
				radians('.$lon.') ) + 
				sin( radians('.$lat.') ) * 
				sin( radians( latitude ) ) ) ) AS distance');
		}else{
			$this -> db -> select('route_stops_id,stop_name,stope_time,latitude,langitude,assigned_to');
		}
		$this -> db -> from('route_stops');
		$this -> db -> where('route_id', $route_id);
		if($traveller_type!=""){
			if($traveller_type==1){
				$trav_type="student";
			}else{
				$trav_type="teacher";
			}
			$this->db->like('assigned_to', $trav_type);
		}
		if($optimize==1){
			if($trip_type==1){
				$this -> db -> order_by('distance','DESC');
			}else{
				$this -> db -> order_by('distance','ASC');
			}
		}
		$query= $this -> db -> get();		
		if($query->num_rows() > 0) {
			$ii=0;
			foreach (($query->result_array()) as $row) {
				$row['count']=$ii;			
				$assigning_to = explode("-",$row['assigned_to']);
				
				if($assigning_to[1]=='student'){
					
					$this -> db -> select('name,parent_id,class_name,section_name,photo');
					$this -> db -> from('student');
					$this->db->where('student_id',$assigning_to[0]);
					$student_query=$this->db->get();
					$row['name'] = $student_query->row('name');
					$parent_id = $student_query->row('parent_id');
					$row['class'] = $student_query->row('class_name');
					$row['section'] = $student_query->row('section_name');
					$row['photo'] = $student_query->row('photo');
					
					$this -> db -> select('Father_Primary_Mobile');
					$this -> db -> from('parent');
					$this->db->where('parent_id',$parent_id);
					$row['contact_num'] = $this->db->get()->row('Father_Primary_Mobile');

				}else if($assigning_to[1]=='teacher'){
					$this -> db -> select('name,mobile,photo');
					$this -> db -> from('employee_details');
					$this -> db -> where('emp_id', $assigning_to[0]);
					$query2 = $this -> db -> get();		
					if($query2->num_rows() > 0) {
						foreach (($query2->result_array()) as $row2) {
							$row['name']=$row2['name'];
							$row['contact_num']=$row2['mobile'];
							$row['photo']=$row2['photo'];
							$row['class'] = "";
							$row['section'] = "";
						}
					}
				}
				$data[] = $row;
				$ii++;
			}
		}
		return $data;
		
	}
	
	function getRouteForTransportAdmin($route_id)
	{
		
		$this -> db -> select('stop_name,stope_time,latitude,langitude,numeric_order');
		$this -> db -> from('route_stops');
		$this -> db -> where('route_id', $route_id);
		$query1 = $this -> db -> get();
		if($query1->num_rows() > 0) {
			foreach (($query1->result_array()) as $row1) {
				$data1[] = $row1;
			}
		}
		return $data1;
		
	}
	
	function addRouteDetails($details){
		$this->db->insert("routes", $details);
		$route_id = $this->db->insert_id();	

		return $route_id;		
	}
	
	function addRouteStopDetails($stop_name,$stop_time,$latitude,$langitude,$assigned_to,$numeric_order,$route_id,$driver_id,$bus_id,$route_distance,$for,$optimize)
	{
		$stop_name_arr = explode(',', urldecode($stop_name));
		$stop_time_arr = explode(',', urldecode($stop_time));
		$latitude_arr = explode(',', urldecode($latitude));
		$langitude_arr = explode(',', urldecode($langitude));
		$assigned_to_arr = explode(',', urldecode($assigned_to));
		$numeric_order_arr = explode(',', urldecode($numeric_order));
		$route_id_arr = explode(',', urldecode($route_id));

		//get trip_type by route_id
		$this -> db -> select('trip_type');
		$this -> db -> from('routes');
		$this->db->where('route_id',$route_id_arr[0]);
		$trip_type = $this->db->get()->row('trip_type');
		
		//unlink Student from the route
		if($trip_type==1){
			$StuData=array('pickup_route_id'=>0);
			$this->db->where('pickup_route_id',$route_id_arr[0]);
			$this->db->update('student',$StuData);	
		}else if($trip_type==2){
			$StuData=array('drop_route_id'=>0);
			$this->db->where('drop_route_id',$route_id_arr[0]);
			$this->db->update('student',$StuData);	
		}
		//unlink teacher and drivers from the route
		if($trip_type==1){
			$TeaData=array('pickup_route_id'=>0);
			$this->db->where('pickup_route_id',$route_id_arr[0]);
			$this->db->update('employee_details',$TeaData);	
		}else if($trip_type==2){
			$TeaData=array('drop_route_id'=>0);
			$this->db->where('drop_route_id',$route_id_arr[0]);
			$this->db->update('employee_details',$TeaData);	
		}
		
		/* //unlink driver from the route
		if($trip_type==1){
			$DriverData=array('pickup_route_id'=>0);
			$this->db->where('pickup_route_id',$route_id_arr[0]);
			$this->db->update('driver_details',$DriverData);	
		}else if($trip_type==2){
			$DriverData=array('drop_route_id'=>0);
			$this->db->where('drop_route_id',$route_id_arr[0]);
			$this->db->update('driver_details',$DriverData);	
		} */
		
		//unlink bus from the route
		if($trip_type==1){
			$busData=array('pickup_route_id'=>0);
			$this->db->where('pickup_route_id',$route_id_arr[0]);
			$this->db->update('bus_details',$busData);	
		}else if($trip_type==2){
			$busData=array('drop_route_id'=>0);
			$this->db->where('drop_route_id',$route_id_arr[0]);
			$this->db->update('bus_details',$busData);	
		}
		
		//delete the old route for reassign
		$this->db->where('route_id', $route_id_arr[0]);
		$this->db->delete('route_stops');
		for ($i = 0; $i < count($latitude_arr); $i++){

			//get trip_type by route_id
			$this -> db -> select('trip_type');
			$this -> db -> from('routes');
			$this->db->where('route_id',$route_id_arr[$i]);
			$trip_type = $this->db->get()->row('trip_type');
			
	
			//Update Distace and optimize for this route
				$RouteData=array('route_distance'=>$route_distance,
					'optimize' => $optimize);
				$this->db->where('route_id',$route_id_arr[$i]);
				$this->db->update('routes',$RouteData);	
					
			if($for!='transfer' && $for!=null){
				//Assign Driver & Bus and optimize to this route
				$RouteData=array('bus_Id'=>$bus_id,'driver_id'=>$driver_id, 'optimize' =>$optimize);
				$this->db->where('route_id',$route_id_arr[$i]);
				$this->db->update('routes',$RouteData);	
				
				//Assign route to bus
				$BusData=array();
				if($trip_type==1){
					$BusData=array('pickup_route_id'=>$route_id_arr[$i]);
				}else{
					$BusData=array('drop_route_id'=>$route_id_arr[$i]);
				}
				$this->db->where('bus_Id',$bus_id);
				$this->db->update('bus_details',$BusData);	
				
				//

				//Assign route to Driver 
				$DriverData=array();
				if($trip_type==1){
					$DriverData=array('pickup_route_id'=>$route_id_arr[$i],'assigned_bus'=>$bus_id);
				}else{
					$DriverData=array('drop_route_id'=>$route_id_arr[$i],'assigned_bus'=>$bus_id);
				}
				$this->db->where('emp_id',$driver_id);
				$this->db->update('employee_details',$DriverData);
			}
			

			$assigning_to = explode("-",$assigned_to_arr[$i]);
			
			if($assigning_to[1]=='student'){
				//Assign student to this route
				$StuData=array();
				if($trip_type==1){
					$StuData=array('pickup_route_id'=>$route_id_arr[$i],'assigned_bus'=>$bus_id);
				}else{
					$StuData=array('drop_route_id'=>$route_id_arr[$i],'assigned_bus'=>$bus_id);
				}
				
				$this->db->where('student_id',$assigning_to[0]);
				$this->db->update('student',$StuData);	
				
			}else if($assigning_to[1]=='teacher'){
				//Assign teacher to this route
				$TeaData=array();
				if($trip_type==1){
					$TeaData=array('pickup_route_id'=>$route_id_arr[$i],'assigned_bus'=>$bus_id);
				}else{
					$TeaData=array('drop_route_id'=>$route_id_arr[$i],'assigned_bus'=>$bus_id);
				}
				$this->db->where('emp_id',$assigning_to[0]);
				$this->db->update('employee_details',$TeaData);
			}
			
			$details=array(
				'stop_name' => $stop_name_arr[$i],
				'stope_time' => $stop_time_arr[$i],
				'latitude' => $latitude_arr[$i],
				'langitude' => $langitude_arr[$i],
				'assigned_to' => $assigned_to_arr[$i],
				'numeric_order' => $numeric_order_arr[$i],
				'route_id' => $route_id_arr[$i],
				'trip_type' => $trip_type,
				'assigned_id' => $assigning_to[0],
				'assigned_type' => $assigning_to[1]
				);
			
				$this->db->where('assigned_to',$assigned_to_arr[$i]);
				//$this->db->where('route_id',$route_id_arr[$i]);
				$this->db->where('trip_type',$trip_type);
				$q = $this->db->get('route_stops');

				if ( $q->num_rows() > 0 ){
					$this->db->where('assigned_to',$assigned_to_arr[$i]);
					//$this->db->where('route_id',$route_id_arr[$i]);
					$this->db->where('trip_type',$trip_type);	
					$this->db->update('route_stops',$details);
				}else{
					$this->db->insert("route_stops", $details);
				}				
		}
		return 'Success';		
	}
	

	function getRouteListWithStopCount()
	{
		//SELECT s.route_name,s.trip_type,s.start_time,s.end_time,s.driver_id,s.bus_id, COUNT(r.stop_name) FROM routes s 
		//INNER JOIN route_stops r ON s.route_id=r.route_id WHERE r.route_id=2
		/*$this->db->select('r.route_id,r.route_name,r.trip_type,r.start_time,r.end_time,r.driver_id,r.bus_id, COUNT(s.stop_name) AS stop_count');
			$this->db->from('routes AS r, route_stops AS s');
			$this->db->where('r.route_id = s.route_id');
			$this->db->group_by('s.route_id'); 
			  
			$query = $this -> db -> get();
			if($query->num_rows() > 0) {
				foreach (($query->result()) as $row) {
					$data[] = $row;
				}
				return $data;
			}*/
		
		$this->db->select('route_id,route_name,trip_type,start_time,end_time,driver_id,bus_id,route_distance');
		$this->db->from('routes');
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$this->db->from('route_stops');
				$this->db->where('route_id', $row['route_id']);
				$query1 = $this->db->get();
				if($query1->num_rows() >0){
					$row['stop_count']=$query1->num_rows();
				}else{
					$row['stop_count']='0';	
				}
				
				//get Bus Name by bus_id
				$this -> db -> select('name');
				$this -> db -> from('bus_details');
				$this->db->where('bus_Id',$row['bus_id']);
				$bus_name = $this->db->get()->row('name');
				$row['bus_name']=$bus_name;
				$data[] = $row;
			}
			return $data;
		}

	}
	
	function getRouteList()
	{
		$this -> db -> select('route_id,route_name');	 
		$this -> db -> from('routes');
		
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result()) as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}

	
	function deleteRouteDetails($id)
	{
		$this -> db -> select('trip_type');
		$this -> db -> from('routes');
		$this->db->where('route_id',$id);
		$trip_type = $this->db->get()->row('trip_type');
		
		
		//unlink Student from the route
		if($trip_type==1){
			$StuData=array('pickup_route_id'=>0);
			$this->db->where('pickup_route_id',$id);
			$this->db->update('student',$StuData);	
		}else if($trip_type==2){
			$StuData=array('drop_route_id'=>0);
			$this->db->where('drop_route_id',$id);
			$this->db->update('student',$StuData);	
		}
		//unlink teacher from the route
		if($trip_type==1){
			$TeaData=array('pickup_route_id'=>0);
			$this->db->where('pickup_route_id',$id);
			$this->db->update('employee_details',$TeaData);	
		}else if($trip_type==2){
			$TeaData=array('drop_route_id'=>0);
			$this->db->where('drop_route_id',$id);
			$this->db->update('employee_details',$TeaData);	
		}
		
		//unlink driver from the route
		/* if($trip_type==1){
			$DriverData=array('pickup_route_id'=>0);
			$this->db->where('pickup_route_id',$id);
			$this->db->update('employee_details',$DriverData);	
		}else if($trip_type==2){
			$DriverData=array('drop_route_id'=>0);
			$this->db->where('drop_route_id',$id);
			$this->db->update('employee_details',$DriverData);	
		} */
		
		//unlink bus from the route
		if($trip_type==1){
			$busData=array('pickup_route_id'=>0);
			$this->db->where('pickup_route_id',$id);
			$this->db->update('bus_details',$busData);	
		}else if($trip_type==2){
			$busData=array('drop_route_id'=>0);
			$this->db->where('drop_route_id',$id);
			$this->db->update('bus_details',$busData);	
		}
		
		//delete the route
		$this->db->where('route_id', $id);
		$this->db->delete('routes');
		
		$this->db->where('route_id', $id);
		$this->db->delete('route_stops');
		return "Success";
	}
	
	function addPicnic($details){
		
		if($this->db->insert("picnic", $details)){
			return true;
		}else{
			return false;
		}			
	}
	
	function editPicnic($details,$picnic_id){
		
		$this->db->where('picnic_id',$picnic_id);
			
		if($this->db->update('picnic',$details)){
			return true;
		}else{
			return false;
		}			
	}
	
	
	function deletePicnic($id)
	{
		//delete picnic
		$this->db->where('picnic_id', $id);
		$this->db->delete('picnic');
		
		//delete picnic details
		$this->db->where('picnic_id', $id);
		$this->db->delete('picnic_details');
		
		return "Success";
	}
	
	function addStudentsInPicnic($details){
		extract($details);
		$student_id_arr = explode(',', $student_id);
		$class_id_arr = explode(',', $class_id);
		$section_id_arr = explode(',', $section_id);
		
		for ($i = 0; $i < count($student_id_arr); $i++){
			$WhereArr=array(
			'picnic_id' => $picnic_id,
			'student_id' => $student_id_arr[$i]);
			
			$details=array(
			'picnic_id' => $picnic_id,
			'student_id' => $student_id_arr[$i],
			'class_id' => $class_id_arr[$i],
			'section_id' => $section_id_arr[$i],
			);
			
			$qu = $this->db->get_where('picnic_selected_students', $WhereArr);
			$count = $qu->num_rows(); //counting result from query
			if ( $count==0){
				$this->db->insert("picnic_selected_students", $details);
			}else{
				$this->db->where($WhereArr);
				$this->db->update('picnic_selected_students',$details);
			}
		}
		return true;
	}
	
	function getPicnicList()
	{
		$running_year=$this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
		
		$this -> db -> select('picnic_id,title,from_date,to_date,pickup_time,drop_time,latitude,longitude,year');	 
		$this -> db -> from('picnic');
		$this -> db -> where('year',$running_year);
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$data[] = $row;
			}
			return $data;
		}else{
			return false;
		}
	}
	
	function getSelectedStuListForPicnic($picnic_id)
	{
		$this -> db -> select('*');	 
		$this -> db -> from('picnic_selected_students');
		$this -> db -> where('picnic_id',$picnic_id);
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$row['student_name']=$this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
				$row['class_name']=$this->db->get_where('class' , array('class_id' => $row['class_id']))->row()->name;
				$row['section_name']=$this->db->get_where('section' , array('section_id' => $row['section_id']))->row()->name;
				$data[] = $row;
			}
			return $data;
		}else{
			return false;
		}
	}
	
	function getPicnicStuListForDriver($picnic_id,$driver_id)
	{
		$this -> db -> select('*');	 
		$this -> db -> from('picnic_selected_students');
		$this -> db -> where('picnic_id',$picnic_id);
		$this -> db -> where('driver_id',$driver_id);
		$query = $this -> db -> get();
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$row['student_name']=$this->db->get_where('student' , array('student_id' => $row['student_id']))->row()->name;
				$row['class_name']=$this->db->get_where('class' , array('class_id' => $row['class_id']))->row()->name;
				$row['section_name']=$this->db->get_where('section' , array('section_id' => $row['section_id']))->row()->name;
				$data[] = $row;
			}
			return $data;
		}else{
			return false;
		}
	}

	function assignBusForPicnic($details){
		extract($details);
		
		$student_id_arr = explode(',', $student_id);
		
		for ($i = 0; $i < count($student_id_arr); $i++){
			$WhereArr=array(
			'picnic_id' => $picnic_id,
			'student_id' => $student_id_arr[$i]);
			
			$details=array(
			'picnic_id' => $picnic_id,
			'student_id' => $student_id_arr[$i],
			'bus_id' => $bus_id,
			'driver_id' => $driver_id,
			'teacher_id' => $teacher_id
			);
			
			$this->db->where($WhereArr);
			$this->db->update('picnic_selected_students',$details);
		}
		return true;
	}
	
	function unAssignBusFromPicnic($picnic_id,$bus_id){
		
		$WhereArr=array(
			'picnic_id' => $picnic_id,
			'bus_id' => $bus_id);
			
		$details=array(
			'bus_id' => 0,
			'driver_id' => 0,
			'teacher_id' => NULL);
			
		$this->db->where($WhereArr);
		if($this->db->update('picnic_selected_students',$details)){
			return true;
		}else{
			return false;
		}
	}
	
	
	function getPicnicListForDriver($driver_id)
	{
		$running_year=$this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
		
		/* $this -> db -> select('picnic_id,title,from_date,to_date,pickup_time,drop_time,latitude,longitude,year');	 
		$this -> db -> from('picnic');
		$this -> db -> where('year',$running_year); */
		
		$query=$this->db->query("SELECT P.picnic_id,P.title,P.from_date,P.to_date,P.pickup_time,P.drop_time,P.latitude,P.longitude,P.year 
			FROM picnic P INNER JOIN picnic_selected_students S ON P.picnic_id=S.picnic_id 
			WHERE S.driver_id=".$driver_id." AND P.year='".$running_year."' AND S.status=1 GROUP BY P.picnic_id");
		if($query->num_rows() > 0) {
			foreach (($query->result_array()) as $row) {
				$data[] = $row;
			}
			return $data;
		}else{
			return false;
		}
	}
	
	function updatePicnicStatus($picnic_id,$driver_id){
		
		$WhereArr=array(
			'picnic_id' => $picnic_id,
			'driver_id' => $driver_id);
			
		$details=array('status' => 2);
			
		$this->db->where($WhereArr);
		if($this->db->update('picnic_selected_students',$details)){
			return true;
		}else{
			return false;
		}
	}
	
	
}
?>