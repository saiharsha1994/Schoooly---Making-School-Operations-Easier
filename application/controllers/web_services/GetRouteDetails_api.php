<?php
require(APPPATH.'/libraries/REST_Controller.php');

class GetRouteDetails_api extends REST_Controller
{
	function __construct()
	{
 		parent::__construct();
		$this->load->model('Getroutedetails_model');
		$this->load->database();
	}

//	http://localhost/Tifly_Pro/index.php/web_services/GetRouteDetails_api/listRoutes
	function listRoutes_get()
    {
		$data = $this->Getroutedetails_model->getRouteList();
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

//	http://localhost/Tifly_Pro/index.php/web_services/GetRouteDetails_api/RoutesListStops
	function RoutesListStops_get()
    {
		$data = $this->Getroutedetails_model->getRouteListWithStopCount();
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

//	http://localhost/Tifly_Pro/index.php/web_services/GetRouteDetails_api/StopsListByRoute/route_id/1
	function StopsListByRoute_get()
    {
		$data = $this->Getroutedetails_model->getStopListByRouteId($this->get('route_id'),"");
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

	
//	http://localhost/UIISR/index.php/web_services/GetRouteDetails_api/getRouteByDriver/driver_id/1/trip_type/1/route_id/1
	function getRouteByDriver_get()
    {
		$data = $this->Getroutedetails_model->getRouteForDriverId($this->get('driver_id'),$this->get('trip_type'),$this->get('route_id'));
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
	
	//	http://localhost/UIISR/index.php/web_services/GetRouteDetails_api/getRouteForAdmin/route_id/1
	function getRouteForAdmin_get()
    {
		$data = $this->Getroutedetails_model->getRouteForTransportAdmin($this->get('route_id'));
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
	
	//	http://localhost/Tifly_Pro/index.php/web_services/GetRouteDetails_api/createRoute/route_name/R5/trip_name/1/start_time/05:00 AM/end_time/08:00 AM
	function createRoute_post()
    {
		$details=array(
				'route_name' => urldecode($this->post('route_name')),
				'trip_type' => urldecode($this->post('trip_name')),
				'start_time' => urldecode($this->post('start_time')),
				'end_time' => urldecode($this->post('end_time'))
				);
				
				
				//'driver_id' => urldecode($this->get('driver_id')),
				//'bus_id' => urldecode($this->get('bus_id'))
				
		$data = $this->Getroutedetails_model->addRouteDetails($details);
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = $data;
			$this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "No records found";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Tifly_Pro/index.php/web_services/GetRouteDetails_api/createRouteStops/stop_name/stop1/stop_time/05:30 AM/latitude/24.200323/langitude/40.065233/numeric_order/1/route_id/1/assigned_to/1-student/driver_id/2/bus_id/2/route_distance/45/for/transfer
	
	function createRouteStops_post()
    {
		$data = $this->Getroutedetails_model->addRouteStopDetails($this->post('stop_name'),$this->post('stop_time'),$this->post('latitude'),
													$this->post('langitude'),$this->post('assigned_to'),
													$this->post('numeric_order'),$this->post('route_id'),
													$this->post('driver_id'),$this->post('bus_id'),
													$this->post('route_distance'),$this->post('for'),$this->post('optimize'));
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

//	http://localhost/UIISR/index.php/web_services/GetRouteDetails_api/deleteRoute/route_id/1
	function deleteRoute_post()
    {
		$data = $this->Getroutedetails_model->deleteRouteDetails($this->post('route_id'));
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
	
	//	http://localhost/Schoooly/index.php?web_services/GetRouteDetails_api/createPicnic
	function createPicnic_post()
    {
		$running_year=$this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
		$details=array(
				'title' => urldecode($this->post('title')),
				'from_date' => urldecode($this->post('from_date')),
				'to_date' => urldecode($this->post('to_date')),
				'pickup_time' => urldecode($this->post('pickup_time')),
				'drop_time' => urldecode($this->post('drop_time')),
				'latitude' => urldecode($this->post('latitude')),
				'longitude' => urldecode($this->post('longitude')),
				'year' => $running_year);
				
		$data = $this->Getroutedetails_model->addPicnic($details);
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = $data;
			$this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "No records found";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Schoooly/index.php?web_services/GetRouteDetails_api/editPicnic
	function editPicnic_post()
    {
		$running_year=$this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
		$details=array(
				'title' => urldecode($this->post('title')),
				'from_date' => urldecode($this->post('from_date')),
				'to_date' => urldecode($this->post('to_date')),
				'pickup_time' => urldecode($this->post('pickup_time')),
				'drop_time' => urldecode($this->post('drop_time')),
				'latitude' => urldecode($this->post('latitude')),
				'longitude' => urldecode($this->post('longitude')),
				'year' => $running_year);
				
		$data = $this->Getroutedetails_model->editPicnic($details,$this->post('picnic_id'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = $data;
			$this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "No records found";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Schoooly/index.php?web_services/GetRouteDetails_api/deletePicnic
	function deletePicnic_post()
    {
		$data = $this->Getroutedetails_model->deletePicnic($this->post('picnic_id'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['responsemsg'] = "deleted";
			$this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "No records found";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Schoooly/index.php?web_services/GetRouteDetails_api/addStudentsPicnic
	function addStudentsPicnic_post()
    {
		$details=array(
				'picnic_id' => urldecode($this->post('picnic_id')),
				'student_id' => urldecode($this->post('student_id')),
				'class_id' => urldecode($this->post('class_id')),
				'section_id' => urldecode($this->post('section_id')));
				
		$data = $this->Getroutedetails_model->addStudentsInPicnic($details);
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
	
	//	http://localhost/Schoooly/index.php?web_services/GetRouteDetails_api/getPicnic
	function getPicnic_get()
    {
		$data = $this->Getroutedetails_model->getPicnicList();
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr'] = $data;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "No records found";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Schoooly/index.php?web_services/GetRouteDetails_api/getSelectedStudentsPicnic/picnic_id/1
	function getSelectedStudentsPicnic_get()
    {
		$data = $this->Getroutedetails_model->getSelectedStuListForPicnic($this->get('picnic_id'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr'] = $data;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "No records found";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Schoooly/index.php?web_services/GetRouteDetails_api/assignBusForPicnic
	function assignBusForPicnic_post()
    {
		$details=array(
				'picnic_id' => urldecode($this->post('picnic_id')),
				'bus_id' => urldecode($this->post('bus_id')),
				'driver_id' => urldecode($this->post('driver_id')),
				'teacher_id' => urldecode($this->post('teacher_id')),
				'student_id' => urldecode($this->post('student_id')));
				
		$data = $this->Getroutedetails_model->assignBusForPicnic($details);
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
	
	//	http://localhost/Schoooly/index.php?web_services/GetRouteDetails_api/unAssignBusFromPicnic
	function unAssignBusFromPicnic_post()
    {
		$data = $this->Getroutedetails_model->unAssignBusFromPicnic($this->post('picnic_id'),$this->post('bus_id'));
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
	
	//	http://localhost/Schoooly/index.php?web_services/GetRouteDetails_api/getPicnicStudentListForDriver/picnic_id/1/driver_id/1
	function getPicnicStudentListForDriver_get()
    {
		$data = $this->Getroutedetails_model->getPicnicStuListForDriver($this->get('picnic_id'),$this->get('driver_id'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr'] = $data;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "No records found";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Schoooly/index.php?web_services/GetRouteDetails_api/getPicnicForDriver/driver_id/1
	function getPicnicForDriver_get()
    {
		$data = $this->Getroutedetails_model->getPicnicListForDriver($this->get('driver_id'));
        if($data)
        {
			$ret_val ['responsecode'] = 1;
			$ret_val ['result_arr'] = $data;
			$ret_val ['responsemsg'] = "Success";
			$this->response($ret_val,200);
        }
		else
        {
			$ret_val ['responsecode'] = 2;
			$ret_val ['responsemsg'] = "No records found";
            $this->response($ret_val, 404);
        }
	}
	
	//	http://localhost/Schoooly/index.php?web_services/GetRouteDetails_api/updatePicnicStatus
	function updatePicnicStatus_post()
    {
		$data = $this->Getroutedetails_model->updatePicnicStatus($this->post('picnic_id'),$this->post('driver_id'));
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